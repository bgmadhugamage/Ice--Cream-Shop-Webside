<?php

include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
}else{
    $seller_id ='';
    header('location:login.php');
}//update order form database
if(isset($_POST['update_order'])){
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id,FILTER_SANITIZE_STRING);

    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var(['update_payment',FILTER_SANITIZE_STRING]);

    $update_pay = $conn->prepare("UPDATE  `orders`  SET payment_status = ? WHERE id = ?");
    
    $update_pay->execute([$update_payment,$order_id]) ;
$success_msg[] = 'order payment status updated';
}
//delete order

 

?>

<!DOCTYPE html>
<lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-Registed Users Page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    
	
<!--  *****   Link To Font Awsome Icons   *****  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
</head>
<body>
   
    <div class="main-container">
        <?php include '../components/admin_header.php';?>
        
        <section class="user-container">
        <div class="heading">
            <h1>Register Users</h1>
            <img src="../img/separator-img.png">
        </div>
        
        <div class="box-container">
        <?php
        $select_user = $conn->prepare("SELECT * FROM `users`");
        $select_users->execute();
        if($select_users->rowCount() > 0){
            while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                $user_id = $fetch_users['id']
               ?>
               <div class="box">
                <img src="../uploaded_files/<?= $fetch_users['image']; ?>">
                <p>User id:<span><?= $users_id?></span></p>
                <p>User Name:<span><?= $fetch_users['name']?></span></p>
                <p>User email:<span><?= $fetch_users['email']?></span></p>
               </div>

                <?php
            }
        }else{
            echo '
            <div class ="empty">
            <p>No user registed yet!<p>
            </div>
            ';
        }
        ?>
            
      
        </div>
    </section>
    </div>


    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php';
?>

</body>
</html>