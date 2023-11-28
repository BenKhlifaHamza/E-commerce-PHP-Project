<?php


include "connect.php" ; 

$table = "users";
$data = array("user_name"=>"hamza",
              "user_email"=>"hamza@gmail.com",
              "user_phone"=>"123",
              "user_verifyCode"=>"85469",
              "user_password"=>"123456"
            );

            $count = insertData($table , $data);



?>