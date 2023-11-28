<?php
include '../../connect.php';
$delivery_id = filterRequest('delivery_id');
$where = "order_delivery_id ='$delivery_id' AND order_status = 'in way'";
getAllData("ordersview",$where);
?>