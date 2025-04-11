<?php

include '../components/connect.php';

if (isset($_POST['submit'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename; // Fixed path

    // Fix SQL query syntax
    $select_seller = $conn->prepare("SELECT * FROM `seller` WHERE email = ?");
    $select_seller->execute([$email]);

    if ($select_seller->rowCount() > 0) {
        $warning_msg[] = 'Email already exists';
    } else {
        if ($pass != $cpass) {
            $warning_msg[] = 'Confirm password does not match';
        } else {
            // Corrected query to match the columns
            $insert_seller = $conn->prepare("INSERT INTO `seller` (id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
            $insert_seller->execute([$id, $name, $email, $pass, $rename]);

            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $success_msg[] = 'New seller registered! Please login now.';
            //} else {
                //$warning_msg[] = 'Failed to upload image';
            }
        }
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
            <h3>register now</h3>
        <div  class="flex">
            <div class="col">
                <div class="input-filed">
                    <p>Your name<span>*</span></p>
                    <input type="text" name="name" placeholder="Enter Your Name" maxlength="50" 
                    required class="box">
                </div>

                <div class="input=fileds">
                    <p> Youe Email<span>*</span></p>
                    <input type="email" name="email" placeholder="Enter Your Email" maxlength="50" 
                    required class="box">
                </div>
            </div>
                <div class="col">
                        <div class="input-filed">
                            <p>Your password<span>*</span></p>
                            <input type="password" name="pass" placeholder="Enter Your password" maxlength="50" 
                            required class="box">
                        </div>
                        <div class="input-fileds">
                            <p>Confirm password<span>*</span></p>
                            <input type="password" name="cpass" placeholder="Enter Your password" maxlength="50" 
                            required class="box">
                        </div>
                </div> 
                <div class="input-fileds">
                <p>Your Profile<span>*</span></p><input type="file" name="image" accept="image/*" 
                    required class="box">
                </div>
                <p class="link">Already have a account?<a href="login.php">Login Now</a></p>
                <input type="submit" name="submit" value="registernow"  class="btn">
            </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/script.js"></script>
<?php include '../components/alert.php';
?>


</body>
</html>