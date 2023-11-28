<?php

include "../../connect.php";

$verifycode =rand(10000,99999);
$admin_email = filterRequest('admin_email');

$count = updateData("admin",array("admin_verifyCode"=>$verifycode),"admin_email = '$admin_email'",false);
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
        sendEmail($admin_email,"E-commerce Verify Code","Your Code : $verifycode");
    } else {
        echo json_encode(array("status" => "failure"));
    }
?>