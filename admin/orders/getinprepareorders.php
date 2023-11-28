<?php
include '../../connect.php';
$where = "order_status = 'in preparation'";
getAllData("orders",$where);
?>