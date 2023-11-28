<?php

 include "../connect.php";
 
 $user_id = filterRequest('user_id');
 $item_id = filterRequest('item_id');
 
 $data = array("favorite_user_id"=>$user_id , "favorite_item_id"=>$item_id);
 
 insertData("favorites",$data);
?>