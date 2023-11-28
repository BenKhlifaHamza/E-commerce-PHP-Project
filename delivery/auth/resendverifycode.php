<?php

include "../../connect.php";

$verifycode =rand(10000,99999);
$delivery_email = filterRequest('delivery_email');

$count = updateData("delivery",array("delivery_verifyCode"=>$verifycode),"delivery_email = '$delivery_email'",false);
    if ($count > 0) {
        echo json_encode(array("status" => "success"));
        sendEmail($delivery_email,"E-commerce Verify Code","Your Code : $verifycode");
    } else {
        echo json_encode(array("status" => "failure"));
    }
?>