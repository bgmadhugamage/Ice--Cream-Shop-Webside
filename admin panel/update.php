
<?php

include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
}else{
    $seller_id ='';
    header('location:login.php');
}

if (isset($_COOKIE['submit'])) {
   

$select_seller = $conn->prepare("SELECT * FROM `seller` WHERE id =? LIMIT 1");
$select_seller->execute([$seller_id]);
$fetch_seller = $select_seller->fetch(PDO::FETCH_ASSOC);

$prev_pass = $fetch_seller['password'];
$prev_image = $fetch_seller['image'];

$name = $_POST['name'];
$name =  filter_var($name,FILTER_SANITIZE_STRING);

$email = $_POST['email'];
$email =  filter_var($email,FILTER_SANITIZE_STRING);
//update  name
if(!empty($name)){
$update_name = $conn->prepare("UPDATE   `seller` SET name = ? WHERE id =?");
$update_name->execute([$name,$seller_id]);
$success_msg[] = 'username updated successfully';
        }
        //update email
        if(!empty($email)){
            $select_email = $conn->prepare("SELECT * FROM   `seller` WHERE id = ? AND  email =?");
            $select_email->execute([$email,$seller_id]);
                if($select_email->rowCount() > 0){
                $warning_msg[] = 'email already exist';
                    }else{
                        $update_email = $conn->prepare("UPDATE   `seller` SET name = ? WHERE id =?");
                        $update_email->execute([$email,$seller_id]);
                        $success_msg = 'email updated successfully';
                        }

                    }
            //update image
            $image = $_FILES['image']['name'];
            $image = filter_var($image,FILTER_SANITIZE_STRING);
            $ext = pathinfo($image,PATHINFO_EXTENSION);
            $rename = unique_id().'.'.$ext;
            $image_size = $_FILTER['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../uploaded_files/'.$rename;

            if(!empty($image)){
                if($image_size > 20000000000){
                    $warning_msg[] = 'incorrect size is do large';
                }else{
                    $update_image = $conn->prepare("UPDATE 'seller' SET 'image' = ? WHERE id = ?");
                    $update_image->execute([$rename,$seller_id]);
                    move_uploaded_file($image_tmp_name,$image_folder);
                    
                    if($prev_image != '' AND $prev_image != $rename){
                        unlink('../uploaded_files/'.$prev_image);
                    }
                    $success_msg[] = 'image updated successully';
                }
            }
            //update password
            $empty_pass = 'da39a3ee5e6b40d3255bfef95601890fd80fd80709';

            $old_pass = sha1($_POST['old_pass']);
            $old_pass = filter_var($old_pass,FILTER_SANITIZE_STRING);

            $new_pass = sha1($_POST['new_pass']);
            $new_pass = filter_var($new_pass,FILTER_SANITIZE_STRING);

            $cpass = sha1($_POST['cpass']);
            $cpass = filter_var($cpass,FILTER_SANITIZE_STRING);
            if($old_pass  != $empty_pass){
                if($old_pass != $prev_pass){
                    $warning_msg[] = 'old password not matched';

                }elseif($new_pass != $cpass){
                    $warning_msg[] = 'password not matched';
                }
            }else{
                if($new_pass != $empty_pass){
                    $update_pass = $conn->prepare("UPDATE seller SET password = ? WHERE id = ?");
                    $update_pass->execute([$cpass,$seller_id]);
                    $success_msg[] = 'password updated successuly';
                }else{
                    $warning_msg[] = 'please enter a new password';

                }
            }

         }

    
?>

<!DOCTYPE html>
<lang="en">
<head>
    <meta charset="UTF-8">'
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer-Update Profile page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    
	
<!--  *****   Link To Font Awsome Icons   *****  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
</head>
<body>
   
    <div class="main-container">
        <?php include '../components/admin_header.php';?>
        
        <section class="form-container">
        <div class="heading">
            <h1>Update Profile Details</h1>
            <img src="../img/separator-img.png">
           </div>
           <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-box">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
            </div>
            
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your Name<span>*</span></p>
                        <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
                    </div>
                        <div class="input-field">
                            <p>Your Email<span>*</span></p>
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
                        </div>
                    <div class="input-field">
                        <p>Select Picture<span>*</span></p>
                        <input type="file" name="image" accept="/image" class="box">
                    </div>
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>Old Password<span>*</span></p>
                        <input type="password" name="old_password" placeholder="Enter Your Old Password" class="box">
                    </div>

                <div class="input-field">
                    <p>New Password<span>*</span></p>
                    <input type="password" name="new_password" placeholder="Enter Your New password" class="box">
                </div>
                <div class="input-field">
                    <p>Confirm Password<span>*</span></p>
                    <input type="password" name="cpassword" placeholder="Confirm Your password" class="box">
                </div>
            </div>
        </div>
        <input type="submit" name="submit" value="update Profile" class="btn">
    </form>
</section>
</div>


    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../js/admin_script.js"></script>
<?php include '../components/alert.php';
?>


</body>
</html>