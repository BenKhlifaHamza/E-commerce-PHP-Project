<?php

include '../connect.php';

$userId = filterRequest("cart_user_id");
$itemId = filterRequest("cart_item_id");

$stm = $con->prepare("SELECT cart_id , cart_count FROM cart WHERE cart_user_id = ? AND  cart_item_id = ? AND cart_order_id = 0");

$stm -> execute(array($userId,$itemId)) ;

$count  = $stm->rowCount();

if ($count > 0 ){
    deleteData('cart',"cart_user_id = $userId and  cart_item_id = $itemId");
}
?>