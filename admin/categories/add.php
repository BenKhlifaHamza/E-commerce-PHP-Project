<?php
include '../../connect.php';
$categorie_name = filterRequest('categorie_name');
$categorie_name_ar = filterRequest('categorie_name_ar');
$categorie_image = imageUpload('../../categories/images/','categorie_image');
$data = array("categorie_name"     => $categorie_name,
"categorie_name_ar" => $categorie_name_ar,
"categorie_image"   => $categorie_image,);
insertData("categories",$data);
?>