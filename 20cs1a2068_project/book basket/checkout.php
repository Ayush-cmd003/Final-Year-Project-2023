<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

$method = array(
   'online' => 'Pay Online',
   'cod' => 'Cash on Delivery'
);

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, ''. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }

    // Get selected payment option
    $selected_payment_option = $_POST['method'];

    // Process payment based on selected option
    if ($selected_payment_option == 'online') {

      header('location:paypay.php?uid='. $user_id);

    } else if ($selected_payment_option == 'cod') {
      
      mysqli_query($conn, "UPDATE `orders` SET `payment_status` = 'COD' WHERE `orders`.`payment_status` = 'pending' AND `orders`.`user_id` = '$user_id';");
            header('location:reciept.php?uid='. $user_id);

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rs.'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> Grand Total : <span>Rs.<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
    
   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `users` where id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select_user) > 0){
              while($fetch_user = mysqli_fetch_assoc($select_user)){
   ?>

      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input id="name" type="text" name="name" required placeholder="enter your name" value="<?php echo $fetch_user['name']; ?>">
         </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input type="number" name="number" required placeholder="enter your number" value="<?php echo $fetch_user['phone']; ?>">
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input type="email" name="email" required placeholder="enter your email" value="<?php echo $fetch_user['email']; ?>">
         </div>
         <div class="inputBox">
            <label for="method">Payment Method :</label>
            <select name="method" id="method">
            <?php foreach ($method as $value => $label) : ?>
               <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
           <?php endforeach; ?>
            </select>
         </div>
         <div class="inputBox">
            <span>Location :</span>
            <input type="text" name="flat" required placeholder="e.g. flat no." value="<?php echo $fetch_user['location']; ?>">
         </div>
         <div class="inputBox">
            <span>Sub - Location :</span>
            <input type="text" name="street" required placeholder="e.g. street name" value="<?php echo $fetch_user['sublocation']; ?>">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai" value="<?php echo $fetch_user['city']; ?>">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra" value="<?php echo $fetch_user['state']; ?>">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" required placeholder="e.g. india" value="<?php echo $fetch_user['country']; ?>">
         </div>
         <div class="inputBox">
            <span>Pin Code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456" value="<?php echo $fetch_user['pincode']; ?>">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>
<?php
}
}
else{
   echo '<p class="empty">No Products Added Yet!</p>';
}
?>


</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>