<?php

include "../connect.php";

$username=filterRequest("user_name");
$password=sha1($_POST["user_password"]);
$email=filterRequest("user_email");
$phone=filterRequest("user_phone");
$verifycode =rand(10000,99999);

$stm = $con->prepare("SELECT * FROM users WHERE user_email = ? OR user_phone = ?");
$stm->execute(array($email,$phone));
$count = $stm->rowCount();
if($count>0){
    printFailure("Phone Or Email Already Exists");
}else{
    $data = array (
        "user_name"=>$username,
        "user_email"=>$email,
        "user_phone"=>$phone,
        "user_verifyCode"=>$verifycode,
        "user_password"=>$password,
    );
    sendEmail($email,"E-commerce Verify Code","Your Code : $verifycode");
    insertData("users",$data);
}

?>