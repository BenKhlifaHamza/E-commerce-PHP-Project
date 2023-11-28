<?php
include '../connect.php';
$order_id = filterRequest('order_id');
$where = "cart_order_id = '$order_id'";
getAllData('orderdetailsview' , $where);
?>