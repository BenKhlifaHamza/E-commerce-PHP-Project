<?php

include "../../connect.php";

$email = filterRequest("admin_email");
$verifycode = filterRequest("admin_verifyCode");

$stm = $con->prepare("SELECT * FROM admin WHERE admin_email = '$email' AND admin_verifyCode = '$verifycode'");

$stm->execute();

$count = $stm->rowCount();

if ($count>0) {
    $data = array("admin_approuve" => "1");
    updateData("admin",$data,"admin_email = '$email'");
}else{
  printFailure("Verify Code Not Correct");
}
?>