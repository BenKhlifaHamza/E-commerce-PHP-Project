CREATE VIEW itemsView AS 
SELECT items.* , categories.*
FROM items INNER JOIN categories
ON items.item_categorie = categories.categorie_id



select itemsview1.* , 1 as favorite
from itemsview1 inner join favorites 
on favorites.favorite_item_id = itemsview1.item_id and favorites.favorite_user_id = 53
UNION ALL 
select * , 0 as favorite from itemsview1 WHERE itemsview1.item_id != (select itemsview1.item_id 
from itemsview1 inner join favorites 
on favorites.favorite_item_id = itemsview1.item_id and favorites.favorite_user_id = 53)




SELECT itemsview1.* , 1 AS favorite
FROM itemsview1 INNER JOIN favorites 
ON favorites.favorite_item_id = itemsview1.item_id AND favorites.favorite_user_id = ? 
WHERE itemsview1.categorie_id = ?
UNION ALL 
SELECT * , 0 AS favorite FROM itemsview1 WHERE itemsview1.categorie_id = ? AND itemsview1.item_id NOT IN (SELECT itemsview1.item_id 
FROM itemsview1 INNER JOIN favorites 
ON favorites.favorite_item_id = itemsview1.item_id AND favorites.favorite_user_id = ?)




CREATE OR REPLACE VIEW favoritesview AS
SELECT favorites.* , items.* FROM 
favorites INNER JOIN items ON favorite_item_id = items.item_id


select itemsview1.* , 1 as in_cart
from itemsview1 inner join cart 
on cart.cart_item_id = itemsview1.item_id and cart.cart_user_id = 53
UNION ALL 
select * , 0 as in_cart from itemsview1 WHERE itemsview1.item_id != (select itemsview1.item_id 
from itemsview1 inner join cart 
on cart.cart_item_id = itemsview1.item_id and cart.cart_user_id = 53)

CREATE OR REPLACE VIEW cartview AS 
SELECT cart.* , items.*
FROM cart INNER JOIN items 
ON items.item_id = cart.cart_item_id
WHERE cart_order_id = 0 
GROUP BY cart.cart_item_id , cart.cart_user_id , cart.cart_order_id ;

CREATE OR REPLACE VIEW ordersview AS SELECT orders.* , addresses.* 
FROM orders 
LEFT JOIN addresses ON orders.order_address_id =addresses.address_id ; 

CREATE OR REPLACE VIEW orderdetailsview AS SELECT cart.* , items.* , ordersview.*
FROM cart 
INNER JOIN items 
ON items.item_id = cart.cart_item_id
INNER JOIN ordersview 
ON ordersview.order_id = cart.cart_order_id
WHERE cart_order_id != 0 
GROUP BY cart.cart_item_id , cart.cart_user_id , cart.cart_order_id ;

CREATE OR REPLACE VIEW orderdetailsview AS SELECT cart.* , items.*
FROM cart 
INNER JOIN items 
ON items.item_id = cart.cart_item_id
INNER JOIN ordersview 
ON ordersview.order_id = cart.cart_order_id
WHERE cart_order_id != 0 
GROUP BY cart.cart_item_id , cart.cart_user_id , cart.cart_order_id ;

CREATE OR REPLACE VIEW topselling AS SELECT SUM(cart_count) as top_seller , cart_item_id 
FROM cart 
WHERE cart_order_id != 0
GROUP BY (cart_item_id)
ORDER BY (top_seller) DESC;

CREATE OR REPLACE VIEW homeView AS SELECT SUM(cart_count) as top_seller , cart_item_id ,items.*
FROM cart 
INNER JOIN items ON cart.cart_item_id = items.item_id
WHERE cart_order_id != 0
GROUP BY (cart_item_id)
ORDER BY (top_seller) DESC;

CREATE OR REPLACE VIEW homeView AS SELECT SUM(cart_count) as top_seller , cart_item_id ,items.*
FROM items 
INNER JOIN cart ON cart.cart_item_id = items.item_id
WHERE cart_order_id != 0
GROUP BY (cart_item_id)
ORDER BY (top_seller) DESC;