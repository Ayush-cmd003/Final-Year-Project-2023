<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin_header.css">
    
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!--<title>Dashboard Sidebar Menu</title>--> 
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/bookicon5.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Admin Panel</span>
                    <span class="profession">Book Basket</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="admin_page.php">
                        <i class='bx bxs-home bx-tada bx-rotate-90 icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="admin_products.php">
                        <i class='bx bxs-book-add bx-tada bx-rotate-90 icon' ></i>
                            <span class="text nav-text">Products</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="admin_orders.php">
                        <i class='bx bxs-cart-alt bx-rotate-90 bx-tada icon'></i>
                            <span class="text nav-text">Orders</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="admin_payments.php">
                        <i class='bx bxl-paypal bx-rotate-90 bx-tada icon'></i>
                            <span class="text nav-text">Payments</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="admin_users.php">
                        <i class='bx bxs-user-plus bx-rotate-90 bx-tada icon' ></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="admin_contacts.php">
                        <i class='bx bxs-message-detail bx-tada bx-rotate-90 icon'  ></i>
                            <span class="text nav-text">Messages</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <i class='bx bxs-user bx-tada bx-rotate-90 icon' ></i>
                        <span class="text nav-text">User</span>
                        <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
                    </a>
                </li>

                <li class="">
                    <a href="admin_logout.php">
                    <i class='bx bx-log-out bx-tada bx-rotate-90 icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                
            </div>
        </div>


    </nav>

    <script>
        const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})
    </script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>
</html>
