<?php
include '../../connect.php';
$where = "order_status = 'archived'";
getAllData("orders",$where);
?>