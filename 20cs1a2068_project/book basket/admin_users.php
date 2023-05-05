<?php

include 'config.php';

session_start();


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

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
<body>
   
<?php include 'admin_header.php'; ?>

<section class="dashboard home">

   <h1 class="title"> user accounts </h1>
     
      <table id="myTable" class="hover" >
         <thead >
         <tr  style="font-size:20px;">
      <th scope="col">Username</th>
      <th scope="col">Contact</th>
      <th scope="col">Email</th>
      <th scope="col">Delete Account</th>
    </tr>
         </thead>
    <tbody>
    <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
            <tr  style="background:aliceblue;font-size:1.7em;">
         <td scope="col"  class="border border-dark"><p> <span><?php echo $fetch_users['name']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_users['phone']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><p> <span><?php echo $fetch_users['email']; ?></span> </p></td>
         <td scope="col"  class="border border-success"><a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a></td>
         </tr>
         <?php
         };
      ?>
         </tbody>  
      </table>

</section>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<script>
    let table = new DataTable('#myTable');
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<!-- custom admin js file link  -->
<script src="admin_script.js"></script>

</body>
</html>