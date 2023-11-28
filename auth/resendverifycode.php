<?php

include "../connect.php";

$verifycode =rand(10000,99999);
$user_email = filterRequest('user_email');

$count = updateData("users",array("user_verifyCode"=>$verifycode),"user_email = '$user_email'",false);
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
        sendEmail($user_email,"E-commerce Verify Code","Your Code : $verifycode");
    } else {
        echo json_encode(array("status" => "failure"));
    }
?>