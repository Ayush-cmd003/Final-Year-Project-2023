<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment Error</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>Payment Failed</h3>
   <p> <a href="checkout.php">checkout</a> / payment failed </p>
</div
	<main>
		<div class="container">
			<div class="card">
				<div class="card-header">
					<h2>Oops! Something went wrong.</h2>
				</div>
				<div class="card-body">
					<p>We're sorry, but there was an error processing your payment.</p>
					<p>Please try again or contact customer support if the problem persists.</p>
					<a href="paypay.php?uid='. $user_id"><button class="btn">Try Again</button></a>
				</div>
			</div>
		</div>
	</main>
	<?php include 'footer.php'; ?>
</body>
</html>
