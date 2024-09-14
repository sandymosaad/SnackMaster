


    
    <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a class="navbar-brand mr-3" href="homeUser.php">CAFETERIA</a>
            <a class="nav-link mr-3" href="http://localhost/proj_php/view/user/orderByUser.php">Home</a>
            <a class="nav-link" href="http://localhost/proj_php/view/user/myOrders.php?page-nr=1">My Orders</a>
        </div>
        <div class="d-flex align-items-center">
            <a class="nav-link mr-3" href="../logout.php">Log Out</a>
            <span class="navbar-text text-white mr-3"><?php echo $_SESSION['Name'];?></span>
            <img src="<?php echo $_SESSION['user_image']; ?>" alt="User" style="width:40px; height:40px; border-radius:50%;">
        </div>
    </nav>