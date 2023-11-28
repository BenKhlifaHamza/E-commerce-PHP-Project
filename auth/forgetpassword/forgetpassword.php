<?php

include "../../connect.php";
$email=filterRequest("user_email");
$stm = $con->prepare("SELECT * FROM users WHERE user_email = ?");
$stm->execute(array($email));
$count = $stm->rowCount();
result($count);
if($count > 0 ){
    $verifycode =rand(10000,99999);
    $data = array("user_verifyCode" => $verifycode);
    updateData("users",$data,"user_email = '$email'", false);
    sendEmail($email,"E-commerce Verify Code","Your Code : $verifycode");
}

?>