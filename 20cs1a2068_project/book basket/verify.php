<?php
require('razorpay-php/Razorpay.php');

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment Verification</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
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
<body>


<div class="heading">
   <span class="accent"><h3>Payment Verification</h3></span>
</div>
<div class="paymentContainer"> 

<section class="payment">
    <!-- VERIFY START -->
    
<?php

// require('config.php');

// session_start();

// require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
include("gateway-config.php");
         

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $paymentConfirmed=mysqli_query($conn,"SELECT * from orders where user_id = '$user_id' AND payment_status = 'pending' ");
    while( $paymentConfirmedArr=mysqli_fetch_assoc($paymentConfirmed)){
        $pid=$paymentConfirmedArr["id"];
        $oid=$paymentConfirmedArr["id"];
        $quant=$paymentConfirmedArr["total_products"];
        mysqli_query($conn,"UPDATE orders SET payment_status='paid' WHERE id='$oid'");
        header('location:payment_reciept.php?uid='. $user_id);
    }
}
else
{
    mysqli_query($conn, "DELETE FROM `orders` WHERE `orders`.`payment_status` = 'pending' AND `order`.`user_id`='$user_id'");
    header('location:failure.php?uid='. $user_id);
}
?>
    <!-- VERIFY END -->
  <br>

</section>
</div>


</body>
</html>