<?php
include '../../connect.php';
$where = "order_status = 'in way'";
getAllData("orders",$where);
?>