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
   <title>payment</title>

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!--Boxicons-->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


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

<?php include 'header.php'; ?>

<div class="heading">
   <h3>Payment</h3>
   <p> <a href="checkout.php">checkout</a> / payment </p>
</div>

<?php 
include("gateway-config.php");
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);


$grand_total = 0;
$select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id' AND payment_status = 'pending'") or die('query failed');
while($fetch_orders = mysqli_fetch_assoc($select_orders)){
  
  $total_price = $fetch_orders['total_price'];
  $grand_total += $total_price;
  $name=$fetch_orders['name'];
  $email=$fetch_orders['email'];
  $phoneNo=$fetch_orders['number'];
  $address=$fetch_orders['address'];  
}


$webtitle="Book Basket";
$displayCurrency="INR";
$imageurl= "https://www.linkpicture.com/q/bookicon5.png";

$orderData = [
  'receipt'         => 3456,
  'amount'          => $grand_total * 100, // 2000 rupees in paise
  'currency'        => 'INR',
  'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
  "key"               => $keyId,
  "amount"            => $amount,
  "name"              => $webtitle,
  "description"       => "Read your favourite books",
  "image"             => $imageurl,
  "prefill"           => [
  "name"              => $name,
  "email"             => $email,
  "contact"           => $phoneNo,
  ],
  "notes"             => [
  "address"           => $address,
  "merchant_order_id" => "12312321",
  ],
  "theme"             => [
  "color"             => "#F37254"
  ],
  "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

?>

<div class="checkout">
		<form action="#" method="post">
    <h3 class= "payerDetails">Payer Details</h3>
    <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input id="name" type="text" name="name" required placeholder="enter your name" value="<?php echo $name ?>" disabled>
    </div>
</div>
    <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input id="name" type="text" name="name" required placeholder="enter your name" value="<?php echo $email ?>" disabled>
    </div>
</div>
    <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input id="name" type="text" name="name" required placeholder="enter your name" value="<?php echo $phoneNo ?>" disabled>
         </div>
</div>
         <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input id="name" type="text" name="name" required placeholder="enter your name" value="<?php echo $address ?>" disabled>
         </div>
</div>
         <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input id="name" type="text" name="name" required placeholder="enter your name" value="<?php echo $grand_total ?>" disabled>
         </div>
</div>
		</form>
</div>
  <center>
  <form action="verify.php?uid=<?php echo $user_id; ?>" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="3456"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input class="btn" type="hidden" name="shopping_order_id" value="3456">
</form>
  </center>

</div>
</div>


<?php include 'footer.php'; ?>


</body>
</html>