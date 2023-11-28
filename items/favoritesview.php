<?php
include '../connect.php';

$user_id = filterRequest('user_id');

getAllData("favoritesview","favorite_user_id = ?", array($user_id));
?>