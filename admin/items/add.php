<?php
include '../../connect.php';
$item_name           = filterRequest('item_name');
$item_name_ar        = filterRequest('item_name_ar');
$item_description    = filterRequest('item_description');
$item_description_ar = filterRequest('item_description_ar');
$item_count          = filterRequest('item_count');
$item_active         = filterRequest('item_active');
$item_price          = filterRequest('item_price');
$item_discount       = filterRequest('item_discount');
//$item_date           = filterRequest('item_date');
$item_categorie      = filterRequest('item_categorie');
$item_image          = imageUpload('../../items/images/','item_image');

$data = array("item_name"           =>  $item_name,
              "item_name_ar"        =>  $item_name_ar,
              "item_description"    =>  $item_description,
              "item_description_ar" =>  $item_description_ar,
              "item_image"          =>  $item_image,
              "item_count"          =>  $item_count,
              "item_active"         =>  $item_active,
              "item_price"          =>  $item_price,
              "item_discount"       =>  $item_discount,
              //"item_date"           =>  $item_date,
              "item_categorie"      =>  $item_categorie,
            );

insertData("items",$data);
?>