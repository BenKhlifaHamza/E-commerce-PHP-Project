<?php

include "../../connect.php";

$name=filterRequest("admin_name");
$password=sha1($_POST["admin_password"]);
$email=filterRequest("admin_email");
$phone=filterRequest("admin_phone");
$verifycode =rand(10000,99999);

$stm = $con->prepare("SELECT * FROM admin WHERE admin_email = ? OR admin_phone = ?");
$stm->execute(array($email,$phone));
$count = $stm->rowCount();
if($count>0){
    printFailure("Phone Or Email Already Exists");
}else{
    $data = array (
        "admin_name"=>$name,
        "admin_email"=>$email,
        "admin_phone"=>$phone,
        "admin_verifyCode"=>$verifycode,
        "admin_password"=>$password,
    );
    sendEmail($email,"E-commerce Verify Code","Your Code : $verifycode");
    insertData("admin",$data);
}

?>