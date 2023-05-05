<?php
require('config.php');
$sql="select * from `orders`";
$res=mysqli_query($conn,$sql);
$html='<table><tr><td>Placed_On</td><td>Name</td><td>Number</td><td>Email</td><td>Address</td><td>Total_Products</td><td>Total_Price</td><td>Method</td></tr>';
while($row=mysqli_fetch_assoc($res)){
	$html.='<tr><td>'.$row['placed_on'].'</td><td>'.$row['name'].'</td><td>'.$row['number'].'</td><td>'.$row['email'].'</td><td>'.$row['address'].'</td><td>'.$row['total_products'].'</td><td>'.$row['total_price'].'</td><td>'.$row['method'].'</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=report.xls');
echo $html;
?>