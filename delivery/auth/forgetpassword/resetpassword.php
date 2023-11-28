<?php
include "../../../connect.php";
$email=filterRequest("delivery_email");
$password=sha1($_POST["delivery_password"]);
$data = array("delivery_password"=>$password);
updateData("delivery",$data ,"delivery_email = '$email'")
?>