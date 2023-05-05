<?php
include 'config.php';

session_start();

$message = array();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $location = mysqli_real_escape_string($conn, $_POST['location']);
   $sublocation = mysqli_real_escape_string($conn, $_POST['sublocation']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $state = mysqli_real_escape_string($conn, $_POST['state']);
   $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
   $country = mysqli_real_escape_string($conn, $_POST['country']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

   if($password !== $cpassword){
      header('location:register_error.php');
  }
  $email_check = "SELECT * FROM users WHERE email = '$email'";
  $res = mysqli_query($conn, $email_check);
  if(mysqli_num_rows($res) > 0){
      $message['email'] = "Email that you have entered is already exist!";
  }
  if(count($message) === 0){
      $code = rand(999999, 111111);
      $status = "notverified";
      $insert_data = "INSERT INTO `users`(name, phone, email, location, sublocation, city, state, pincode, country, password, code, status) 
      VALUES('$name', $phone, '$email', '$location', '$sublocation', '$city', '$state', '$pincode', '$country', '$cpassword', '$code', '$status')";
      $data_check = mysqli_query($conn, $insert_data);
      if($data_check){
          $subject = "Email Verification Code";
          $message = "Your verification code is $code";
          $sender = "From: omdaspurkayastha@gmail.com";
          if(mail($email, $subject, $message, $sender)){
              $info = "We've sent a verification code to your email - $email";
              $_SESSION['info'] = $info;
              $_SESSION['email'] = $email;
              $_SESSION['password'] = $password;
              header('location: user-otp.php');
              exit();
          }else{
              $message['otp-error'] = "Failed while sending code!";
          }
      }else{
          $message['db-error'] = "Failed while inserting data into database!";
      }
  }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>



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
   
<div class="form-container" style='background-image:url("images/bookbg7.jpg");background-size: cover;background-position: center;'>

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="tel" name="phone" placeholder="enter your phone number" pattern="[7-9]{1}[0-9]{9}" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="text" name="location" placeholder="enter your location" required class="box">
      <input type="text" name="sublocation" placeholder="enter your sub-loaction" required class="box">
      <input type="text" name="city" placeholder="enter your city" required class="box">
      <input type="text" name="state" placeholder="enter your state" required class="box">
      <input type="text" name="pincode" placeholder="enter your pincode" required class="box">
      <input type="text" name="country" placeholder="enter your country" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <input class="btn" type="submit" name="submit" value="Signup">
      <p>Already have an account? <a href="login.php">Login Now</a></p>
   </form>

</div>

</body>
</html>