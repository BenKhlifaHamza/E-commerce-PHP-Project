<?php
include '../../connect.php';
$categorie_id = filterRequest('categorie_id');
$categorie_name = filterRequest('categorie_name');
$categorie_name_ar = filterRequest('categorie_name_ar');
$categorie_image = $res = imageUpload('../../categories/images/','categorie_image');
$where = "categorie_id = '$categorie_id'" ;

if($res == "fail"){
 printFailure($res);
}else{
    if($categorie_image == "empty"){

        $data = array("categorie_name" => $categorie_name,
                      "categorie_name_ar" => $categorie_name_ar,);
    
    }else{
    
        global $con;
        $stm = $con->prepare("SELECT categorie_image FROM categories WHERE $where");
        $stm->execute();
        $old_image_name = $stm->fetchColumn();
        $count = $stm->rowCount();
        deleteFile('../../categories/images/' ,$old_image_name);
    
       $data = array("categorie_name"     => $categorie_name,
        "categorie_name_ar" => $categorie_name_ar,
        "categorie_image"   => $categorie_image,);
    
    }
    updateData("categories",$data,$where);
}


?>