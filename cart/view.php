<?php
include '../connect.php';

$user_id = filterRequest('cart_user_id');

getAllData("cartview","cart_user_id = ?", array($user_id));
?>