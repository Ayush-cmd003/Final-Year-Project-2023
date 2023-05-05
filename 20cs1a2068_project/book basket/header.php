<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#"><i class='bx bxl-facebook-circle bx-spin' ></i></a>
            <a href="#"><i class='bx bxl-twitter bx-spin' ></i></a>
            <a href="#"><i class='bx bxl-instagram bx-spin' ></i></a>
            <a href="#"><i class='bx bxl-linkedin-square bx-spin' ></i></a>
         </div>
         <p> New <a href="login.php">Login</a> | <a href="register.php">Register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">

      <div class="logo-name">
           <div class="logo-image">
                <img src="images/bookicon5.png" alt="">
            </div>
            <a class="logo_name" href="#">Book <span style="color: #8e44ad;">Basket.<span></a>
      </div>

         <nav class="navbar">
            <a href="home.php">HOME</a>
            <a href="shop.php">SHOP</a>
            <a href="orders.php">ORDERS</a>
            <a href="about.php">ABOUT</a>
            <a href="contact.php">CONTACT</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>