<?php

include "../../../connect.php";

$email = filterRequest("admin_email");
$verifycode = filterRequest("admin_verifyCode");

$stm = $con->prepare("SELECT * FROM admin WHERE admin_email = '$email' AND admin_verifyCode = '$verifycode'");

$stm->execute();

$count = $stm->rowCount();

result($count);
?>