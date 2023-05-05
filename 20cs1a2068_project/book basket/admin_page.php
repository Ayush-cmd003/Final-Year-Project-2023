<?php

include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">

   <link rel="stylesheet" href="admin_header.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard home" style="padding-top: 1.5%; background: url(./images/bookbg6.jpg); background-size: cover; background-position: center top;">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3><i class='bx bxs-wallet' style='color:#c023d4' ></i><br>
          Rs. <?php echo $total_pendings; ?>/-</h3>
         <a href="admin_orders.php"><p>Total Pendings</p></a>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3><i class='bx bx-credit-card' style='color:#c023d4' ></i><br>
         Rs. <?php echo $total_completed; ?>/-</h3>
         <a href="admin_orders.php"><p>Completed Payments</p></a>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><i class='bx bx-cart-add' style='color:#c023d4'  ></i> <br>                                       
         <?php echo $number_of_orders; ?> 
         </h3>
         <a href="admin_orders.php"><p>Order Placed</p></a>
      </div>

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><i class='bx bx-book' style='color:#c023d4' ></i><br>
            <?php echo $number_of_products; ?></h3>
         <a href="admin_products.php"><p>Products Added</p></a>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><i class='bx bxs-user-check' style='color:#c023d4' ></i><br>
            <?php echo $number_of_users; ?></h3>
         <a href="admin_users.php"><p>Customers</p></a>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><i class='bx bxs-user-account' style='color:#c023d4' ></i><br>
            <?php echo $number_of_account; ?></h3>
         <a href="admin_users.php"><p>Total Accounts</p></a>
      </div>

      <div class="box">
         <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><i class='bx bxs-message-rounded-dots' style='color:#c023d4' ></i><br>
            <?php echo $number_of_messages; ?></h3>
         <a href="admin_contacts.php"><p>New Messages</p></a>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->

<!-- custom admin js file link  -->
<script src="admin_script.js"></script>

</body>
</html>