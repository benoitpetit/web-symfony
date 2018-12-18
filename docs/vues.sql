/* Product TShirt */
CREATE VIEW vProduct_tshirt AS
SELECT r.id rate_id,
       CAST(r.rate * 100 AS DECIMAL(5,2)) taux_tva,
       p.price_unit_ht,
       ROUND(p.price_unit_ht * r.rate) as price_tva,
       p.price_unit_ht + ROUND(p.price_unit_ht * r.rate) as price_unit_ttc,
       pt.id product_type_id,
       pt.product_type,
       g.id genre_id,
       g.name,
       c.id color_id,
       c.color_name,
       c.color_hexa,
       l.id logo_id,
       l.logo_name,
       l.slug
  FROM product p INNER JOIN rate r ON p.rate_id_id = r.id
	             INNER JOIN product_type pt ON p.product_type_id_id = pt.id
                 INNER JOIN gender g ON p.gender_id_id = g.id,
	   color c,
       logo l
 WHERE pt.id = 1
ORDER BY g.id,
		 c.id,
         l.id;


/* ORDERS */
CREATE OR REPLACE VIEW vOrders_tshirt AS
SELECT u.id user_id,
	   o.id orders_id,
       o.order_register,
	  (
		 SELECT SUM( ROUND((sol.price_unit_ht - COALESCE(promo_unit_ht, 0)) * (1 + sr.rate), 2)) AS price_ttc
		  FROM user su INNER JOIN address sa ON su.address_billing_id_id = sa.id
					  INNER JOIN orders so ON sa.id = so.address_billing_id_id
					  INNER JOIN order_line sol ON so.id = sol.order_id_id
                      INNER JOIN rate sr ON sol.rate_id = sr.id
		 WHERE su.id = u.id
		   AND so.id = o.id
	  ) price_ttc,
      order_date
  FROM user u INNER JOIN address a ON u.address_billing_id_id = a.id
              INNER JOIN orders o ON a.id = o.address_billing_id_id;
 /* WHERE u.id = 7;*/

SELECT v.* FROM vOrders_tshirt v WHERE v.user_id = 7;

 /* ORDERS LINE */
 CREATE OR REPLACE VIEW vOrderLine_tshirt AS
 SELECT u.id user_id,
		ol.order_id_id order_id,
		ol.product_type_id,
		pt.product_type,
		ol.product_gender_id,
        g.name as gender_name,
        ol.product_color_id,
        c.color_name,
        ol.product_size_id,
        s.size as size_name,
        CONCAT(s.size, ' - ', s.name) AS size_wording,
        ol.product_logo_id,
        l.logo_name,
        ol.quantity,
        ol.price_total_ttc
  FROM user u INNER JOIN address a ON (u.address_billing_id_id = a.id)
              INNER JOIN orders o ON (a.id = o.address_billing_id_id)
              INNER JOIN order_line ol ON (o.id = ol.order_id_id)
              INNER JOIN product_type pt ON (ol.product_type_id = pt.id)
              INNER JOIN gender g ON (ol.product_gender_id = g.id)
              INNER JOIN color c ON (ol.product_color_id = c.id AND c.par_type_product = '@tshirt')
              INNER JOIN size s ON (ol.product_size_id = s.id AND s.par_type_product = '@tshirt')
              INNER JOIN logo l ON (ol.product_logo_id = l.id AND l.par_type_product = '@tshirt');
/*
 WHERE u.id = 7
   AND o.id = 2;
*/
SELECT v.* FROM vOrderLine_tshirt v WHERE v.user_id = 7;
SELECT v.* FROM vOrderLine_tshirt v WHERE v.user_id = 7 AND v.order_id = 4;
