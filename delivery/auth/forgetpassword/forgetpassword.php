<?php

include "../../../connect.php";
$email=filterRequest("delivery_email");
$stm = $con->prepare("SELECT * FROM delivery WHERE delivery_email = ?");
$stm->execute(array($email));
$count = $stm->rowCount();
result($count);
if($count > 0 ){
    $verifycode =rand(10000,99999);
    $data = array("delivery_verifyCode" => $verifycode);
    updateData("delivery",$data,"delivery_email = '$email'", false);
    sendEmail($email,"E-commerce Verify Code","Your Code : $verifycode");
}

?>