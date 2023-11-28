<?php
include '../../connect.php';
$delivery_id = filterRequest('delivery_id');
$where = "order_status = 'archived' AND order_delivery_id = '$delivery_id' ORDER BY order_id DESC";
getAllData("ordersview",$where);
?>