<?php
include '../connect.php';
$cupon_code = filterRequest('cupon_code');
$cupon_exp_date = date('Y-m-d H:i:s');
$where = "cupon_code = '$cupon_code' AND cupon_exp_date > '$cupon_exp_date' AND cupon_count > 0";
getData('cupons',$where);
?>