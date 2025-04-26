<header class="header">
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <section class="flex">
        <a href="home.php" class="logo"><img src="../img/logo.png" width="130px"></a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about-us.php">About us</a>
            <a href="menu.php">Shop</a>
            <a href="order.php">Order</a>
            <a href="contact.php">Contact us</a>
        </nav>
        <form action="" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="search product.." required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" id="search_product_btn" ></button>
        </form>
        <div class="icons">
            <div class="bx bx-list-plus" id="menu-btn"></div>
            <div class="bx bx-search-alt-2" id="search-btn"></div>
            <a href="wishlist.php"><i class="bx bx-heart"></i><sup>0</sup></a>
            <a href="cart.php"><i class="bx bx-cart"></i><sup>0</sup></a>
            <div class="bx bxs-user" id="user-btn"></div>
        </div>
            <div class="profile-detail">
                <?php
                $select_profile = $conn->prepare(  "SELECT * FROM `users` WHERE id = ?");//user_id
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                
                ?>
                <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name']; ?>"></h3>
                <div class="flex-btn">
                <a href="profile.php" class="btn">View Profile</a>
              <a href="components.user_logout.php" onclick="return confirm('log out rom this website');" class="btn">Logout</a>
        </div>
        <?php  
        }else{
        ?>
            <h3 style="margin-bottom: 1rem;">Please Login Or Register</h3>
            <div class="flex-btn">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn" >Register</a>
            </div>
                <?php
                }  ?>
    </div>
    </section>

</header> 