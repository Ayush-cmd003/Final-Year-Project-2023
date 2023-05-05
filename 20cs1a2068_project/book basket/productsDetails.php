<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- displays site properly based on user's device -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <linkh ref="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap" rel="stylesheet"/> 

    <link rel="stylesheet" href="productsDetails.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!--Boxicons-->
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <title>product details</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/4.7.0/css/font-awesome.min.css">

<style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        display: none;
      }
    </style>

  </head>
  <body>

    <?php include('header.php'); ?>
    

    <?php
    if(isset($_GET['ID'])){
    $product_id=mysqli_real_escape_string($conn, $_GET['ID']);
    $select_products = mysqli_query($conn, "SELECT * FROM `products` where id = '$product_id'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
    <div class="heading">
   <h3>Product Details</h3>
   <p style="text-transform: lowercase;"> <a href="shop.php">shop</a> / <?php echo $fetch_products['name']; ?>  </p>
    </div>

    <!-- Main item container -->
    <main class="item">
      <section class="img">
      <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="img-main" />
      </section>

      <section class="price">
        <h2 class="price-sub__heading">Book Basket</h2>
        <h1 class="price-main__heading"><?php echo $fetch_products['name']; ?></h1>
        <p class="price-txt">
        <?php echo $fetch_products['description']; ?>
        </p>
        <div class="price-box">
          <div class="price-box__main">
            <span class="price-box__main-new">Rs. <?php echo $fetch_products['price']; ?></span>
          </div>
        </div>


        <form action="" method="post" class="box">
        <button class="price-btn__add price-btn" type="button" onclick="increment()">
              <img src="images/icon-plus.svg" alt="plus sign" class="price-btn__add-img price-btn__img"/>
            </button>
        <input id=demoInput type="number" min="1" name="product_quantity" value="1" class="qty" style="width: 10%;
   padding:1.2rem 1.4rem;
   text-align: center;
   margin:1rem 0;
   font-size: 2rem">
   <button class="price-btn__remove price-btn" type="button" onclick="decrement()">
              <img src="images/icon-minus.svg" alt="minus sign"class="price-btn__remove-img price-btn__img"/>
            </button>
 <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
 <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
 <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
        <br><input type="submit" value="add to cart" name="add_to_cart" class="btn" style="width: 30%;
   padding:1.2rem 1.4rem;
   border-radius: .5rem;
   border:var(--border);
   margin:1rem 0;
   font-size: 2rem;">
 
</form>
        <?php
    }
  }
 }else{
    echo '<p class="empty">No Products Added Yet!</p>';
 }
 ?>

      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script>
   function increment() {
      document.getElementById('demoInput').stepUp();
   }
   function decrement() {
      document.getElementById('demoInput').stepDown();
   }
</script>

  </body>
</html>


