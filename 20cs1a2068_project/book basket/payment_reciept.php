<?php

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
    <title>Details Pdf</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="print.css" media="print">
    <style>
        .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
    </style>
</head>
<body>

    <div id="invoice">
	<?php  
         $select_orders = mysqli_query($conn, "SELECT * FROM payment WHERE  id = '31'") or die('query failed');
         if(mysqli_num_rows($select_orders) > 0){
			while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Payment ID <?php echo $fetch_orders['id']; ?></h3>
    		</div>
    		<hr>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Name</strong></td>
        							<td class="text-center"><strong>Amount</strong></td>
        							<td class="text-center"><strong>Date</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td><?php echo $fetch_orders['name']; ?></td>
    								<td class="text-center"><?php echo $fetch_orders['amount']; ?></td>
    								<td class="text-center"><?php echo $fetch_orders['added_on']; ?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

</div>
<?php
         }
		}
      ?>

    </div>

	<center><button id="print-btn" class="btn btn-warning" type="button" style="width:20%;font-size:2em;color:white;margin-bottom:35px;margin-left: 20px;margin-top: 15px" onclick="window.print();">Get Reciept</button></center>
	<center><a href="orders.php" id="print-btn"><button id="print-btn" class="btn btn-warning" type="button" style="width:15%;font-size:2em;color:white;margin-bottom:35px;margin-left: 20px">Go Back</button></a></center>


</body>

</html>