<?php

include '../connect.php';
$user_id = filterRequest('user_id');
$order_id = filterRequest('order_id');
$data = array("order_status"=>"in preparation");
$where = "order_id = '$order_id' AND order_status = 'on hold'";
$count = updateData('orders',$data,$where,false);
if ($count>0) {
    insertNotification($user_id , "Order Approuved" , "Your Order Already In Preparation." , "users$user_id" , "none" , "/ordersPage" );
    printSuccess();
}else{
    printFailure();
}
?>