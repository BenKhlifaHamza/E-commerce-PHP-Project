<?php

include 'connect.php';


$allData = array();

$homedata =getData("homedata"," 1=1 ORDER BY ('homedata_id') DESC LIMIT 0, 1" ,null,true);
$categories =getAllData("categories",null,null,false);
$items =getAllData(/*"itemsView1" */"homeView",/*"item_discount != '0'" */null,null,false);


$allData['status'] = 'success';
$allData['homedata'] = $homedata;
$allData['categories'] = $categories;
$allData['items'] = $items;


echo json_encode($allData);

?>