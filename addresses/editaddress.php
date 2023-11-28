<?php
include '../connect.php';

$address_id     = filterRequest('address_id');
$address_name   = filterRequest('address_name');
$address_city   = filterRequest('address_city');
$address_street = filterRequest('address_street');
$address_lat    = filterRequest('address_lat');
$address_long    = filterRequest('address_long');

$data = array("address_name"    => $address_name,
              "address_city"    => $address_city,
              "address_street"  => $address_street,
              "address_lat"     => $address_lat,
              "address_long"    => $address_long,
              
);

$where = "address_id = '$address_id'";

updateData("addresses" , $data , $where);
?> 