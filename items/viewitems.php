<?php

 include '../connect.php';
  
  $categorie_id = filterRequest("categorie_id");
  $user_id = filterRequest("user_id");
   
  $stmt = $con->prepare(
  "SELECT itemsview1.* , 1 AS favorite , (item_price - (item_price * item_discount / 100)) AS item_discount_price 
   FROM itemsview1 
   INNER JOIN favorites 
   ON favorites.favorite_item_id = itemsview1.item_id AND favorites.favorite_user_id = ? 
   WHERE itemsview1.categorie_id = ? AND itemsview1.item_active = 1
   UNION ALL 
   SELECT * , 0 AS favorite , (item_price - (item_price * item_discount / 100)) AS item_discount_price 
   FROM itemsview1 
   WHERE itemsview1.categorie_id = ? AND itemsview1.item_active = 1 AND itemsview1.item_id 
   NOT IN(SELECT itemsview1.item_id FROM itemsview1 INNER JOIN favorites 
   ON favorites.favorite_item_id = itemsview1.item_id AND favorites.favorite_user_id = ?)"
  );
  
  $stmt->execute(array($user_id,$categorie_id,$categorie_id,$user_id));
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count  = $stmt->rowCount();
  
  if ($count > 0) {
      echo json_encode(array("status" => "success", "data" => $data));
  } else {
      echo json_encode(array("status" => "failure"));
  }

  /*SELECT itemsview1.* , 1 AS favorite
   FROM itemsview1 INNER JOIN favorites 
   ON favorites.favorite_item_id = itemsview1.item_id AND favorites.favorite_user_id = ? 
   WHERE itemsview1.categorie_id = ?
   UNION ALL 
   SELECT * , 0 AS favorite FROM itemsview1 WHERE itemsview1.categorie_id = ? AND itemsview1.item_id NOT IN (SELECT itemsview1.item_id 
   FROM itemsview1 INNER JOIN favorites 
   ON favorites.favorite_item_id = itemsview1.item_id AND favorites.favorite_user_id = ?) */
  
?>
