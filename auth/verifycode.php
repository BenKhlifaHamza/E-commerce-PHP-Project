<?php

include "../connect.php";

$email = filterRequest("user_email");
$verifycode = filterRequest("user_verifyCode");

$stm = $con->prepare("SELECT * FROM users WHERE user_email = '$email' AND user_verifyCode = '$verifycode'");

$stm->execute();

$count = $stm->rowCount();

if ($count>0) {
    $data = array("user_approuve" => "1");
    updateData("users",$data,"user_email = '$email'");
}else{
  printFailure("Verify Code Not Correct");
}
?>