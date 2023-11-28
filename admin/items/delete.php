<?php
include '../../connect.php';
$item_id = filterRequest('item_id');
$item_image = filterRequest('item_image');
$where = "item_id = '$item_id'" ;
deleteFile('../../items/images/' ,$item_image );
deleteData("items",$where);
?>