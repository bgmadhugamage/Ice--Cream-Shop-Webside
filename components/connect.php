
//<?php
//replace code
//$db_name = 'mysql:host=localhost:3307;dbname=icecreamshop_db';
/*$user_name = 'root';
//$user_password = '';
//$conn = 'connection';
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn = new PDO($db_name, $user_name, $user_password);
*/




$db_name = 'mysql:host=localhost:3307;dbname=icecreamshop_db';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional success message
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}




function unique_id(){
    $chars = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength =strlen($chars);
    $randomString = '';
    for($i=0; $i < 20; $i++){
        $randomString = $chars[mt_rand(0, $charLength - 1)];
    }

return $randomString;
}
?>