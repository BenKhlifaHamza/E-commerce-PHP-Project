<?php
include '../connect.php';
$user_id = filterRequest('user_id');
$where = "order_user_id = '$user_id' ORDER BY order_date DESC";
getAllData('ordersview', $where);
?>