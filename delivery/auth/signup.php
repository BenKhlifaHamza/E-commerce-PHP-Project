<?php

include "../../connect.php";

$deliveryname=filterRequest("delivery_name");
$password=sha1($_POST["delivery_password"]);
$email=filterRequest("delivery_email");
$phone=filterRequest("delivery_phone");
$verifycode =rand(10000,99999);

$stm = $con->prepare("SELECT * FROM delivery WHERE delivery_email = ? OR delivery_phone = ?");
$stm->execute(array($email,$phone));
$count = $stm->rowCount();
if($count>0){
    printFailure("Phone Or Email Already Exists");
}else{
    $data = array (
        "delivery_name"=>$deliveryname,
        "delivery_email"=>$email,
        "delivery_phone"=>$phone,
        "delivery_verifyCode"=>$verifycode,
        "delivery_password"=>$password,
    );
    sendEmail($email,"E-commerce Verify Code","Your Code : $verifycode");
    insertData("delivery",$data);
}

?>