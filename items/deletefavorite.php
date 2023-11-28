<?php
 include "../connect.php";
 
 $user_id = filterRequest('user_id');
 $item_id = filterRequest('item_id');
 
 deleteData("favorites","favorite_user_id = '$user_id' AND favorite_item_id = '$item_id'");

?>