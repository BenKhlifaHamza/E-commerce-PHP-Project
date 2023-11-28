<?php
include '../../connect.php';
$user_id = filterRequest('user_id');
$order_id = filterRequest('order_id');
$order_delivery_id = filterRequest('order_delivery_id');
$data = array("order_status"=>"in way",
             "order_delivery_id"=>"$order_delivery_id");
$where = "order_id = '$order_id' AND order_status = 'in preparation'";
updateData('orders',$data,$where);
insertNotification($user_id , "Preparation Done" , "Your Order Already In The Way." , "users$user_id" , "none" , "/ordersPage" );
sendGCM("Order Accepted" , "The Order Has Benn Accepted By the Delivery.","admin","none","none");
sendGCM("Order Accepted" , "The Order Has Benn Accepted By the Delivery.","delivery","none","none");
?>