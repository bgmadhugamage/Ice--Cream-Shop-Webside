<?php

include '../components/connect.php';

if (isset($_POST['submit'])) {
    

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    
    // Fix SQL query syntax
    $select_seller = $conn->prepare("SELECT * FROM `seller` WHERE email = ? AND password= ?");
    $select_seller->execute([$email,$pass]);
    $row = $select_seller->fetch(PDO::FETCH_ASSOC);

    if($select_seller->rowCount()>0){
        setcookie('seller_id',$row['id'],time() + 60*60*24*30, '/');
        header('location:dashboard.php');

    }else{
        $warning_msg[] = 'incorrect email or password';
    }
            }
        
    




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-seller registration page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    
	
<!--  *****   Link To Font Awsome Icons   *****  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
</head>
<body>
<div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>Login now</h3>
        <div  class="flex">
            <div class="col">
                <div class="input-filed">
                <div class="col">
                <div class="input-filed">
                    <p>Your password<span>*</span></p><input type="password" name="pass" placeholder="Enter Your password" maxlength="50" 
                    required class="box">
                </div>
                <div class="input=fileds">
                    <p> Youe Email<span>*</span></p><input type="email" name="email" placeholder="Enter Your Email" maxlength="50" 
                    required class="box">
</div>


           
</div>
           

                <p class="link">Dont Have an  account?<a href="login.php">Register Now</a></p>
                <input type="submit" name="submit" value="registernow"  class="btn">
        </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/script.js"></script>
<?php include '../components/alert.php';
?>


</body>
</html><div  class="flex">
<div class="col">