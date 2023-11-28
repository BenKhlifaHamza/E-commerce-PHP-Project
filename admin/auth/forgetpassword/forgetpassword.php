<?php

include "../../../connect.php";
$email=filterRequest("admin_email");
$stm = $con->prepare("SELECT * FROM admin WHERE admin_email = ?");
$stm->execute(array($email));
$count = $stm->rowCount();
result($count);
if($count > 0 ){
    $verifycode =rand(10000,99999);
    $data = array("admin_verifyCode" => $verifycode);
    updateData("admin",$data,"admin_email = '$email'", false);
    sendEmail($email,"E-commerce Verify Code","Your Code : $verifycode");
}

?>