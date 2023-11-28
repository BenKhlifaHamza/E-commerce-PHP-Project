<?php

include "../connect.php";
$email=filterRequest("user_email");
$password=sha1($_POST["user_password"]);

// $stm = $con->prepare("SELECT * FROM users WHERE user_email = ? AND user_password = ? AND user_approuve = ?");
// $stm->execute(array($email,$password,'1'));
// $count = $stm->rowCount();
//result($count);

getData("users","user_email = ? AND user_password = ?",array($email,$password));


?>