<?php
include '../connect.php';
$user_id = filterRequest('user_id');
$where = "address_user_id = '$user_id'";
getAllData('addresses',$where);
?>