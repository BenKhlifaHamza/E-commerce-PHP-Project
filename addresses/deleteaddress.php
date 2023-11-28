<?php
include '../connect.php';
$address_id = filterRequest('address_id') ;
$where = "address_id = '$address_id'";
deleteData("addresses",$where);
?> 