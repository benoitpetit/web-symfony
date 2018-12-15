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

SELECT v.* FROM vProduct_tshirt v WHERE v.genre_id = 1;
