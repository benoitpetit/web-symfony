INSERT INTO `address` (`
id`,
`address_type
`, `street`, `zip_code`, `city`, `country`, `created_date`) VALUES
(1, '@BILLING', '33, rue de Groussay', '26100', 'ROMANS-SUR-ISÈRE', 'France', '2018-12-14 09:00:00'),
(2, '@BILLING', '44, rue des six frères Ruellan', '95110', 'SANNOIS', 'France', '2018-12-14 09:00:00'),
(3, '@BILLING', '83, rue des Soeurs', '83130', 'LA GARDE', 'France', '2018-12-14 09:00:00'),
(4, '@BILLING', '31, rue Lenotre', '35700', 'RENNES', 'France', '2018-12-14 09:00:00'),
(5, '@DELIVERY', '31, rue Lenotre', '35700', 'RENNES', 'France', '2018-12-14 09:00:00');

INSERT INTO `color` (`
id`,
`color_name
`, `color_hexa`, `created_date`) VALUES
(1, 'blue', '#3399ff', '2018-12-14 09:00:00'),
(2, 'yellow', '#FDC008', '2018-12-14 09:00:00'),
(3, 'green', '#2eb82e', '2018-12-14 09:00:00'),
(4, 'red', '#cc0000', '2018-12-14 09:00:00'),
(5, 'black', '#000000', '2018-12-14 09:00:00'),
(6, 'purple', '#993399', '2018-12-14 09:00:00');

INSERT INTO `gender` (`
id`,
`created_date
`, `name`) VALUES
(1, '2018-12-14 09:00:00', 'homme'),
(2, '2018-12-14 09:00:00', 'femme');

INSERT INTO `logo` (`
id`,
`logo_name
`, `slug`, `link`, `created_date`) VALUES
(1, 'C ++ mieux', 'c_mieux', 'images/c_mieux.png', '2018-12-14 09:00:00'),
(2, 'Classik', 'class_ik', 'images/class_ik.png', '2018-12-14 09:00:00'),
(3, 'Endive', 'en_div_e', 'images/en_div_e.png', '2018-12-14 09:00:00'),
(4, 'Entre quote', 'entre_quote', 'images/entre_quote.png', '2018-12-14 09:00:00'),
(5, 'Formidable', 'form_idable', 'images/form_idable.png', '2018-12-14 09:00:00'),
(6, 'Game Hover', 'game_hover', 'images/game_hover.png', '2018-12-14 09:00:00'),
(7, 'Getter Setter', 'getter_setter', 'images/getter_setter.png', '2018-12-14 09:00:00'),
(8, 'Idfix', 'id_fix', 'images/id_fix.png', '2018-12-14 09:00:00'),
(9, 'La belle est la Bête', 'la_belle_et_la_bete', 'images/la_belle-et-la-bete.png', '2018-12-14 09:00:00'),
(10, 'Libellul', 'li_bell_ul', 'images/li_bell_ul.png', '2018-12-14 09:00:00'),
(11, 'Lorem et Hardy', 'lorem_et_hardy', 'images/lorem_et_hardy.png', '2018-12-14 09:00:00'),
(12, 'Quiche Lorem', 'quiche_lorem', 'images/quiche_lorem.png', '2018-12-14 09:00:00'),
(13, 'Sensassionnel', 'sass', 'images/sass.png', '2018-12-14 09:00:00'),
(14, 'Toggle toi-même', 'toggle', 'images/toggle.png', '2018-12-14 09:00:00'),
(15, 'What else', 'what_else', 'images/what_else.png', '2018-12-14 09:00:00');

INSERT INTO `orders` (`
id`,
`address_billing_id_id
`, `address_delivery_id_id`, `order_register`, `order_date`, `created_date`) VALUES
(1, 1, NULL, '125048624', '2018-12-14 09:00:00', '2018-12-14 09:00:00'),
(2, 2, 5, '753695186', '2018-12-14 10:00:00', '2018-12-14 10:00:00');

INSERT INTO `order_line` (`
id`,
`order_id_id
`, `product_id`, `product_color_id`, `product_logo_id`, `product_size_id`, `product_gender_id`, `quantity`, `price_unit_ht`, `promo_unit_ht`, `rate_id`, `price_total_ttc`, `created_date`) VALUES
(1, 1, 1, 3, 6, 2, 2, 2, 20, NULL, 1, 48, '2018-12-14 12:00:00'),
(2, 2, 2, 6, 15, 3, 1, 1, 20, NULL, 1, 24, '2018-12-14 12:00:00');

INSERT INTO `product_type` (`
id`,
`product_type
`, `created_date`) VALUES
(1, 't-shirt', '2018-12-14 10:00:00');

INSERT INTO `rate` (`
id`,
`rate_date_start
`, `rate_date_end`, `created_date`, `rate`) VALUES
(1, '2018-12-14 10:00:00', NULL, '2018-12-14 10:00:00', 0.2);

INSERT INTO `size` (`
id`,
`size
`, `created_date`) VALUES
(1, 's', '2018-12-14 10:00:00'),
(2, 'm', '2018-12-14 10:00:00'),
(3, 'l', '2018-12-14 10:00:00'),
(4, 'xl', '2018-12-14 10:00:00');

INSERT INTO `user`
    (`id`, `address_billing_id_id
`, `username`, `firstname`, `lastname`, `email`, `password`, `phone`, `roles`, `is_active`, `created_date`) VALUES
(1, 1, 'Aembett', 'Akim', 'Embett', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0621524185', 'a:1:{i:0;s:10:\"ROLE_BUYER\";}', 0, '2018-12-14 11:00:00'),
(2, 2, 'Bglace', 'Brice', 'Glace', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0685968574', 'a:1:{i:0;s:9:\"ROLE_ADMIN\";}', 0, '2018-12-14 11:00:00'),
(3, 3, 'Gtar', 'Guy', 'Tar', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0758932145', 'a:1:{i:0;s:10:\"ROLE_BUYER\";}', 0, '2018-12-14 11:00:00'),
(4, 4, 'Jcelert', 'Jacques', 'Célert', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0682829206', 'a:1:{i:0;s:10:\"ROLE_BUYER\";}', 0, '2018-12-14 11:00:00');

ALTER TABLE `devmyshirts`.`product`
DROP FOREIGN KEY `FK_D34A04ADEF048774`,
DROP FOREIGN KEY `FK_D34A04ADE22F468B`,
DROP FOREIGN KEY `FK_D34A04AD6F7F214C`;
ALTER TABLE `devmyshirts`.`product`
DROP INDEX `IDX_D34A04AD6F7F214C` ,
DROP INDEX `UNIQ_D34A04ADEF048774` ,
DROP INDEX `UNIQ_D34A04ADE22F468B` ;
;

INSERT INTO `product` (`
id`,
`product_type_id_id
`, `rate_id_id`, `gender_id_id`, `price_unit_ht`, `created_date`) VALUES
(1, 1, 1, 2, 20, '2018-12-14 10:00:00'),
(2, 1, 1, 1, 20, '2018-12-14 09:00:00');

ALTER TABLE `devmyshirts`.`stock_input`
DROP FOREIGN KEY `FK_44382E26E88CCE5`,
DROP FOREIGN KEY `FK_44382E26DE18E50B`,
DROP FOREIGN KEY `FK_44382E26AE945C60`;
ALTER TABLE `devmyshirts`.`stock_input`
DROP INDEX `UNIQ_44382E26DE18E50B` ,
DROP INDEX `UNIQ_44382E26AE945C60` ,
DROP INDEX `UNIQ_44382E26E88CCE5` ;
;

INSERT INTO `stock_input` (`
id`,
`color_id_id
`, `size_id_id`, `product_id_id`, `input_date`, `quantity`, `created_date`) VALUES
(1, 5, 3, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(2, 5, 2, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(3, 5, 1, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(4, 5, 4, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(5, 1, 1, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(6, 1, 2, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(7, 1, 3, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(8, 1, 4, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(9, 3, 1, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(10, 3, 2, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(11, 3, 3, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(12, 3, 4, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(13, 6, 1, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(14, 6, 2, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(15, 6, 3, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(16, 6, 4, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(17, 4, 1, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(18, 4, 2, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(19, 4, 3, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(20, 4, 4, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(21, 2, 1, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(22, 2, 2, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(23, 2, 3, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(24, 2, 4, 1, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(25, 5, 1, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(26, 5, 2, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(27, 5, 3, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(28, 5, 4, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(29, 1, 1, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(30, 1, 2, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(31, 1, 3, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(32, 1, 4, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(33, 3, 1, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(34, 3, 2, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(35, 3, 3, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(36, 3, 4, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(37, 6, 1, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(38, 6, 2, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(39, 6, 3, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(40, 6, 4, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(41, 4, 1, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(42, 4, 2, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(43, 4, 3, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(44, 4, 4, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(45, 2, 1, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(46, 2, 2, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(47, 2, 3, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00'),
(48, 2, 4, 2, '2018-12-14 08:00:00', 20, '2018-12-14 11:00:00');
