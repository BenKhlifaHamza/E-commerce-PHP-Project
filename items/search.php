<?php

include "../connect.php";

$item_name = filterRequest('item_name');

if(!empty($item_name)){
    getAllData("itemsview1","item_name LIKE '%$item_name%' OR item_name_ar LIKE '%$item_name%'");
}

?>