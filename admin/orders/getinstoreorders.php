<?php
include '../../connect.php';
$where = "order_status = 'in store'";
getAllData("orders",$where);
?>