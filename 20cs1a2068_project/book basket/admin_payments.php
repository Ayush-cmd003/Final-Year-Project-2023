<?php

include 'config.php';

session_start();

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `payment` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_payments.php');
}

?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">

   <link rel="stylesheet" href="admin_header.css">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <style>
      .dataTables_filter input 
      { width: 200px }
    </style>

</head>
<body style="background: url(./images/bookbg6.jpg); background-size: cover; background-position: center;">
   
<?php include 'admin_header.php'; ?>

<section class="dashboard home">

   <h1 class="title">Payments</h1>

      <table id="myTable" class="hover" >
         <thead >
         <tr class="table-active table-primary border border-success"  style="font-size:20px;">
      <th scope="col">Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Payment Id</th>
      <th scope="col">Date</th>
      <th scope="col">Delete Order</th>
    </tr>
         </thead>
    <tbody>
    <?php
      $select_payments = mysqli_query($conn, "SELECT * FROM `payment`") or die('query failed');
      if(mysqli_num_rows($select_payments) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_payments)){
      ?>
            <tr style="background:aliceblue;font-size:1.7em;">
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_orders['name']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_orders['amount']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_orders['payment_status']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_orders['payment_id']; ?>/-</span> </p></td>
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_orders['added_on']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><form action="" method="post">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">Delete</a>
         </form></td>
         </tr>

         <?php
         }
      }else{
         echo '<p class="empty">No Orders Placed yet!</p>';
      }
      ?>

         </tbody>  
      </table>

         <center><a href="payment_report.php"><button type="button" class="btn btn-warning" style="width:15%;font-size:2em;color:white;margin-top:35px">Download Report</button></a></center>


</section>



<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<script>
    let table = new DataTable('#myTable');
</script>




<!-- custom admin js file link  -->
<script src="admin_script.js"></script>

</body>
</html>