<?php
include "../../../connect.php";
$email=filterRequest("admin_email");
$password=sha1($_POST["admin_password"]);
$data = array("admin_password"=>$password);
updateData("admin",$data ,"admin_email = '$email'")
?>