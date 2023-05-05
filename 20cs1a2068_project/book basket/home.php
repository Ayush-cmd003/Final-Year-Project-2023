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
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

   <!--swipper link-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <!--Boxicons-->
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

   <style>
	.img-container{
		max-width: 1200px;
        margin:0 auto;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
	}
	

	.img-box{
		width: 25%;
		margin: 0 10px;
		box-shadow: 0 0 20px 2px rgba(0, 0, 0, .1);
		transition: 1s;

	}
	.img-box img{
		display: block;
		width:100%;
		border-radius: 5px;
	}
	.img-box:hover{
		transform: scale(1.1);
		z-index: 2;
	}
	</style>

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3 class="animate__animated animate__bounceInLeft">Welcome to BOOK BASKET</h3>
            <p>Purchase your favourite books</p>
            <a href="shop.php" class="btn hvr-ripple-out">shop now</a>
        </div>

        <div class="swiper books-slider">
            <div class="swiper-wrapper">
                <a href="shop.php" class="swiper-slide"><img src="images/book-1.png" alt=""></a>
                <a href="shop.php" class="swiper-slide"><img src="images/book-2.png" alt=""></a>
                <a href="shop.php" class="swiper-slide"><img src="images/book-3.png" alt=""></a>
                <a href="shop.php" class="swiper-slide"><img src="images/book-4.png" alt=""></a>
                <a href="shop.php" class="swiper-slide"><img src="images/book-5.png" alt=""></a>
                <a href="shop.php" class="swiper-slide"><img src="images/book-6.png" alt=""></a>
            </div>
            <img src="images/stand.png" class="stand" alt="">
        </div>

    </div>

</section>

<section class="icons-container">

    <div class="icons">
        <i class="fas fa-shipping-fast"></i>
        <div class="content">
            <h3>free shipping</h3>
            <p>order over $100</p>
        </div>
    </div>

    <div class="icons">
        <i class="fas fa-lock"></i>
        <div class="content">
            <h3>secure payment</h3>
            <p>100 secure payment</p>
        </div>
    </div>

    <div class="icons">
        <i class="fas fa-redo-alt"></i>
        <div class="content">
            <h3>easy returns</h3>
            <p>10 days returns</p>
        </div>
    </div>

    <div class="icons">
        <i class="fas fa-headset"></i>
        <div class="content">
            <h3>24/7 support</h3>
            <p>call us anytime</p>
        </div>
    </div>

</section>

<section class="products">

   <h1 class="title">Our Products</h1>

   <div class="box-container img-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">

     <div class="box">
     <a href="productsDetails.php?ID=<?php echo $fetch_products['id']; ?>"><img class="image img-box" style="width:90%;" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""></a>
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs. <?php echo $fetch_products['price']; ?>/-</div>
      </div>
     </form>
      <?php
         }
      }
      ?>

   </div>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

   
   <div class="img-container">
      <div class="image img-box">
         <img src="images/about-img.jpg" alt="">
      </div>
    </div>

      <div class="content">
         <h3>about us</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>


<?php include 'footer.php'; ?>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>