<?php

include '../../connect.php';
$user_id = filterRequest('user_id');
$order_id = filterRequest('order_id');
$data = array("order_status"=>"archived");
$where = "order_id = '$order_id' AND order_status = 'in way'";
updateData('orders',$data,$where);
insertNotification($user_id , "Order Completed" , "Received successfully, thank you for your trust." , "users$user_id" , "none" , "/ordersPage" );
sendGCM("Order Completed" , "The Order Has Benn Completed With Successfully.","admin","none","none");
?>