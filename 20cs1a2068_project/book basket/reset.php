<?php

include 'config.php';

if(isset($_POST['submit'])){


   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));


   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
    if($password != $cpassword){
        $message[] = 'confirm password not matched!';
     }else{
        mysqli_query($conn, "UPDATE `users` SET password = $cpassword WHERE password = $password") or die('query failed');
        $message[] = 'Password Updated Successfully!';
        header('location:login.php');
     }
      
   }else{
    $message[] = 'user already exist!'; 
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
   
<div class="form-container">

   <form action="" method="post">
      <h3>Reset Password</h3>
      <input type="password" name="password" placeholder="enter your new password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your new password" required class="box">
      <input type="submit" name="submit" value="Reset Now" class="btn">
      <p>Remenber password? <a href="login.php">Login Now</a></p>
   </form>

</div>

</body>
</html>