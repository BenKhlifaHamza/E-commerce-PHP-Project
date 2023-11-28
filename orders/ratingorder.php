<?php
include '../connect.php';
$order_id = filterRequest('order_id');
$order_rating = filterRequest('order_rating');
$order_comment = filterRequest('order_comment');

$where = "order_id = '$order_id'";
$data = array ("order_rating"=>$order_rating,
               "order_comment"=>$order_comment);

updateData('orders',$data, $where);
 ?>