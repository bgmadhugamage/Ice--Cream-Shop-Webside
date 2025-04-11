<header>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">




    <div class="logo">
        <img src="../img/logo.png" width="150">
    </div>
    <div class="right">
    <div class = "bx bxs-user" id ="user-btn"></div>
    <div class="toggle-btn"><i class="bx bx-menu"></i></div>
    </div>
    <div class="profile-detail">
        

<?php
        $select_profile = $conn->prepare("SELECT * FROM `seller` WHERE id= ?");
        $select_profile->execute([$seller_id]);
        if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
 
   
?><div class="profile" >
    <img src="../uploaded_files/<?= $fetch_profile['image'];?>"
    class="logo-img" width="100">
    <p>
        <?= $fetch_profile['name']; ?></p>
        <div class="flex-btn">
            <a href=" profile.php" class = "btn"> Profile</a>
            <a href="../components/admin_logout.php" onclick="return confirm('log out fron this website?'>;"class="btn">Logout</a>
        </div>

</div>
<?php } ?>
</div>
</header>
<div class="sidebar-container">
    <div class="sidebar">
    <?php
        $select_profile = $conn->prepare("SELECT * FROM `seller` WHERE id= ?");
        $select_profile->execute([$seller_id]);
        if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
 
   
?><div class="profile" >
    <img src="../uploaded_files/<?= $fetch_profile['image'];?>"
    class="logo-img" width="200">
    <p>
        <?= $fetch_profile['name'];?></p>
        
    </div>
    <?php } ?>

    <h5>Menu</h5>

<div class="navbar">
    <ul>
    <li><a href="dashboard.php"><i class="bx bxs-home-smile"></i> Dashboard</a></li>
    <li><a href="add_products.php"><i class="bx bxs-shopping-bags"></i> Add Products</a></li>
    <li><a href="view_product.php"><i class="bx bxs-food-menu"></i> View Product</a></li>
    <li><a href="user_account.php"><i class="bx bxs-user-detail"></i> User Account</a></li>
    <li><a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');">
        <i class="bx bx-log-out"></i> Log out
    </a></li>
</ul>

</div><h5>Find Us</h5>
<div class="social-link">
    
    <i class="bx bxl-facebook"></i>
    <i class="bx bxl-linkedin"></i>
    <i class="bx bxl-instagram-alt"></i>
    <i class="bx bxl-twitter"></i>
    <i class="bx bxl-pinterest-alt"></i>
</div>
</div>
        </div>