<?php

include '../../connect.php' ; 
$where = "order_status ='in preparation' AND order_delivery_type ='0'";
getAllData("ordersview",$where);


?>