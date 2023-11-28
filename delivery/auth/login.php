<?php

include "../../connect.php";
$email=filterRequest("delivery_email");
$password=sha1($_POST["delivery_password"]);

// $stm = $con->prepare("SELECT * FROM deliverys WHERE delivery_email = ? AND delivery_password = ? AND delivery_approuve = ?");
// $stm->execute(array($email,$password,'1'));
// $count = $stm->rowCount();
//result($count);

getData("delivery","delivery_email = ? AND delivery_password = ?",array($email,$password));
