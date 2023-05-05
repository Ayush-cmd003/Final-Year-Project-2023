<!DOCTYPE html>
<html>
  <head>
    <title>Cart Updated</title>
    <style>
      @keyframes success {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.message {
  background-color: #2ecc71;
  color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
  animation: success 0.5s ease-in-out;
}

.message h2 {
  margin-top: 0;
  font-size: 32px;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #fff;
  color: #2ecc71;
  text-decoration: none;
  border-radius: 5px;
  transition: all 0.3s ease-in-out;
  margin-top: 20px;
}

.btn:hover {
  background-color: #2ecc71;
  color: #fff;
  transform: scale(1.1);
}


    </style>
  </head>
  <body>

  <div class="container">
		<div class="message">
			<h2>CART UPDATED</h2>
			<p>Your cart has been updated.</p>
			<a href="shop.php" class="btn">Continue Shopping</a>
            <a href="checkout.php" class="btn">Checkout</a>
            <a href="cart.php" class="btn">Go Back</a>
		</div>
	</div>

  </body>
</html>