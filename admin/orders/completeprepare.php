<?php

include '../connect.php';
$user_id = filterRequest('user_id');
$order_id = filterRequest('order_id');
$order_delivery_type = filterRequest('order_delivery_type');

$where = "order_id = '$order_id' AND order_status = 'in preparation'";

if($order_delivery_type == "0"){
    sendGCM("New Order" , "There Is A New Order Waiting.","delivery","none","none");
    printSuccess();
}else{
    $data = array("order_status"=>"in store");
    $count = updateData('orders',$data,$where , false);
    if($count>0)
    { 
        insertNotification($user_id , "Order Prepared" , "Your order has been prepared, it is waiting for you in the store." , "users$user_id" , "none" , "/ordersPage" );
        printSuccess();
    }else{
        printFailure();
    }
}

?>