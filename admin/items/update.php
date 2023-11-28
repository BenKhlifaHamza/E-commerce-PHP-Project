<?php
include '../../connect.php';
$item_id             = filterRequest('item_id');
$item_name           = filterRequest('item_name');
$item_name_ar        = filterRequest('item_name_ar');
$item_description    = filterRequest('item_description');
$item_description_ar = filterRequest('item_description_ar');
$item_count          = filterRequest('item_count');
$item_active         = filterRequest('item_active');
$item_price          = filterRequest('item_price');
$item_discount       = filterRequest('item_discount');
$item_categorie      = filterRequest('item_categorie');
$item_image = $res   = imageUpload('../../items/images/','item_image');

$where = "item_id = '$item_id'" ;

if($res == "fail"){
 printFailure($res);
}else{
    if($item_image == "empty"){

        $data = array(
        "item_name"           =>  $item_name,
        "item_name_ar"        =>  $item_name_ar,
        "item_description"    =>  $item_description,
        "item_description_ar" =>  $item_description_ar,
        "item_count"          =>  $item_count,
        "item_active"         =>  $item_active,
        "item_price"          =>  $item_price,
        "item_discount"       =>  $item_discount,
        "item_categorie"      =>  $item_categorie,
      );
    
    }else{
    
        global $con;
        $stm = $con->prepare("SELECT item_image FROM items WHERE $where");
        $stm->execute();
        $old_image_name = $stm->fetchColumn();
        $count = $stm->rowCount();
        deleteFile('../../items/images/' ,$old_image_name);
    
       $data = array(
       "item_name"           =>  $item_name,
       "item_name_ar"        =>  $item_name_ar,
       "item_description"    =>  $item_description,
       "item_description_ar" =>  $item_description_ar,
       "item_image"          =>  $item_image,
       "item_count"          =>  $item_count,
       "item_active"         =>  $item_active,
       "item_price"          =>  $item_price,
       "item_discount"       =>  $item_discount,
       "item_categorie"      =>  $item_categorie,
     );
    }
    updateData("items",$data,$where);
}


?>