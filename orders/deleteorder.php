<?php
include '../connect.php';
$order_id = filterRequest('order_id');
$where = "order_id = '$order_id' AND order_status = 'on hold'";
deleteData('orders',$where);
?>