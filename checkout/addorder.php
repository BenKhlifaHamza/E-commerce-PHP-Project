<?php
include '../connect.php';

$order_user_id        = filterRequest('order_user_id');
$order_price	       = filterRequest('order_price');
$order_address_id     = filterRequest('order_address_id');
$order_payment_type	 = filterRequest('order_payment_type');
$order_cupon_id       = filterRequest('order_cupon_id');
$order_delivery_price = filterRequest('order_delivery_price');
$order_delivery_type  = filterRequest('order_delivery_type');


if($order_delivery_type == "0"){
  $order_total_price = $order_price + $order_delivery_price ;
}else{
  $order_total_price = $order_price;
  $order_delivery_price = 0 ;
}

if($order_cupon_id != "0"){
  
  //////////////////////////////Utilisation du coupon

   $cupon_exp_date = date('Y-m-d H:i:s');
   $stm = $con->prepare("SELECT * FROM cupons WHERE cupon_id = '$order_cupon_id' AND cupon_exp_date > '$cupon_exp_date' AND cupon_count > 0");
   $stm->execute();
   $verifCupons = $stm->rowCount(); 

 if( $verifCupons > 0){

  $stm = $con->prepare("UPDATE cupons SET cupon_count = cupon_count - 1");
  $stm->execute();

   $data = array('order_user_id'        => $order_user_id,
                 'order_price'          => $order_price,
                 'order_address_id'     => $order_address_id,
                 'order_payment_type'   => $order_payment_type,
                 'order_cupon_id'       => $order_cupon_id,
                 'order_delivery_price' => $order_delivery_price,
                 'order_delivery_type'  => $order_delivery_type,
                 'order_total_price'    => $order_total_price,
            );

 $count = insertData('orders',$data , false);

  if($count > 0){

    $stm = $con->prepare("SELECT MAX(order_id) FROM orders WHERE order_user_id = '$order_user_id'" );
    $stm->execute();

    $last_order = $stm->fetchColumn();

    $data = array('cart_order_id' => $last_order);
    $where = "cart_user_id = '$order_user_id' AND cart_order_id = 0";

    updateData('cart',$data,$where);

  }else {echo json_encode(array("status" => "failure")); }
   
                               
}else {echo json_encode(array("status" => "failure"));}
   
}else{
   
   $data = array('order_user_id'        => $order_user_id,
                 'order_price'          => $order_price,
                 'order_address_id'     => $order_address_id,
                 'order_payment_type'   => $order_payment_type,
                 'order_cupon_id'       => $order_cupon_id,
                 'order_delivery_price' => $order_delivery_price,
                 'order_delivery_type'  => $order_delivery_type,
                 'order_total_price'    => $order_total_price,
 );              

$count = insertData('orders',$data , false);

if($count > 0){

$stm = $con->prepare("SELECT MAX(order_id) FROM orders WHERE order_user_id = '$order_user_id'" );
$stm->execute();

$last_order = $stm->fetchColumn();

$data = array('cart_order_id' => $last_order);
$where = "cart_user_id = '$order_user_id' AND cart_order_id = 0";

updateData('cart',$data,$where);
}else {echo json_encode(array("status" => "failure"));}

}
?>