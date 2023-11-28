<?php
include '../../connect.php';
$where = "order_status = 'on hold'";
getAllData("orders",$where);
?>