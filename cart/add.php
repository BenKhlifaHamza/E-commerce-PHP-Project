<?php

include '../connect.php';

$userId = filterRequest("cart_user_id");
$itemId = filterRequest("cart_item_id");
$cartCount = filterRequest("cart_count");

$data = array('cart_user_id'=>$userId,'cart_item_id'=>$itemId,'cart_count'=>$cartCount);

$stm = $con->prepare("SELECT cart_id FROM cart WHERE cart_user_id = ? and  cart_item_id = ?  AND cart_order_id = 0");

$stm -> execute(array($userId,$itemId)) ;

$count  = $stm->rowCount();

if ($count == 0 ){
    insertData("cart",$data);
}else {
    updateData('cart',$data,"cart_user_id = $userId and  cart_item_id = $itemId");
}
?>