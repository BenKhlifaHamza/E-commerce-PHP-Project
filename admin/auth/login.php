<?php

include "../../connect.php";
$email=filterRequest("admin_email");
$password=sha1($_POST["admin_password"]);

// $stm = $con->prepare("SELECT * FROM admin WHERE admin_email = ? AND admin_password = ? AND admin_approuve = ?");
// $stm->execute(array($email,$password,'1'));
// $count = $stm->rowCount();
//result($count);

getData("admin","admin_email = ? AND admin_password = ?",array($email,$password));
