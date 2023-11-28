<?php
 include "../connect.php";
 
 $favorite_id = filterRequest('favorite_id');
 
 deleteData("favorites","favorite_id = '$favorite_id'");

?>