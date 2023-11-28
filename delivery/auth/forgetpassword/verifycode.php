<?php

include "../../../connect.php";

$email = filterRequest("delivery_email");
$verifycode = filterRequest("delivery_verifyCode");

$stm = $con->prepare("SELECT * FROM delivery WHERE delivery_email = '$email' AND delivery_verifyCode = '$verifycode'");

$stm->execute();

$count = $stm->rowCount();

result($count);
?>