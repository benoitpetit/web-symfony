-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 14 déc. 2018 à 15:12
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `devmyshirts`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address_type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `address`
--

INSERT INTO `address` (`id`, `address_type`, `street`, `zip_code`, `city`, `country`, `created_date`) VALUES
(1, '@BILLING', '33, rue de Groussay', '26100', 'ROMANS-SUR-ISÈRE', 'France', '2018-12-14 09:00:00'),
(2, '@BILLING', '44, rue des six frères Ruellan', '95110', 'SANNOIS', 'France', '2018-12-14 09:00:00'),
(3, '@BILLING', '83, rue des Soeurs', '83130', 'LA GARDE', 'France', '2018-12-14 09:00:00'),
(4, '@BILLING', '31, rue Lenotre', '35700', 'LILLE', 'France', '2018-12-14 09:00:00'),
(5, '@BILLING', '31, rue du paradis', '59200', 'Paris', 'France', '2018-12-10 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_hexa` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `color`
--

INSERT INTO `color` (`id`, `color_name`, `color_hexa`, `created_date`) VALUES
(1, 'blue', '#3399ff', '2018-12-14 09:00:00'),
(2, 'yellow', '#FDC008', '2018-12-14 09:00:00'),
(3, 'green', '#2eb82e', '2018-12-14 09:00:00'),
(4, 'red', '#cc0000', '2018-12-14 09:00:00'),
(5, 'black', '#000000', '2018-12-14 09:00:00'),
(6, 'purple', '#993399', '2018-12-14 09:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gender`
--

INSERT INTO `gender` (`id`, `created_date`, `name`) VALUES
(1, '2018-12-14 09:00:00', 'homme'),
(2, '2018-12-14 09:00:00', 'femme');

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `logo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `logo`
--

INSERT INTO `logo` (`id`, `logo_name`, `slug`, `link`, `created_date`) VALUES
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
(15, 'What else', 'what_else', 'images/what_else.png', '2018-12-14 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181214085539'),
('20181214092806'),
('20181214093018'),
('20181214100638');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `address_billing_id_id` int(11) NOT NULL,
  `address_delivery_id_id` int(11) DEFAULT NULL,
  `order_register` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `address_billing_id_id`, `address_delivery_id_id`, `order_register`, `order_date`, `created_date`) VALUES
(1, 1, NULL, '125048624', '2018-12-14 09:00:00', '2018-12-14 09:00:00'),
(2, 2, NULL, '753695186', '2018-12-14 10:00:00', '2018-12-14 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `order_line`
--

CREATE TABLE `order_line` (
  `id` int(11) NOT NULL,
  `order_id_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_color_id` int(11) NOT NULL,
  `product_logo_id` int(11) NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `product_gender_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_unit_ht` double NOT NULL,
  `promo_unit_ht` double DEFAULT NULL,
  `rate_id` int(11) NOT NULL,
  `price_total_ttc` double NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_line`
--

INSERT INTO `order_line` (`id`, `order_id_id`, `product_id`, `product_color_id`, `product_logo_id`, `product_size_id`, `product_gender_id`, `quantity`, `price_unit_ht`, `promo_unit_ht`, `rate_id`, `price_total_ttc`, `created_date`) VALUES
(1, 1, 1, 3, 6, 2, 2, 2, 20, NULL, 1, 48, '2018-12-14 12:00:00'),
(2, 2, 2, 6, 15, 3, 1, 1, 20, NULL, 1, 24, '2018-12-14 12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_type_id_id` int(11) NOT NULL,
  `rate_id_id` int(11) NOT NULL,
  `gender_id_id` int(11) NOT NULL,
  `price_unit_ht` double NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `product_type_id_id`, `rate_id_id`, `gender_id_id`, `price_unit_ht`, `created_date`) VALUES
(1, 1, 1, 2, 20, '2018-12-14 10:00:00'),
(2, 1, 1, 1, 20, '2018-12-14 09:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_type`
--

INSERT INTO `product_type` (`id`, `product_type`, `created_date`) VALUES
(1, 't-shirt', '2018-12-14 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `rate_date_start` datetime NOT NULL,
  `rate_date_end` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rate`
--

INSERT INTO `rate` (`id`, `rate_date_start`, `rate_date_end`, `created_date`, `rate`) VALUES
(1, '2018-12-14 10:00:00', NULL, '2018-12-14 10:00:00', 0.2);

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `size`, `created_date`) VALUES
(1, 's', '2018-12-14 10:00:00'),
(2, 'm', '2018-12-14 10:00:00'),
(3, 'l', '2018-12-14 10:00:00'),
(4, 'xl', '2018-12-14 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `stock_input`
--

CREATE TABLE `stock_input` (
  `id` int(11) NOT NULL,
  `color_id_id` int(11) NOT NULL,
  `size_id_id` int(11) NOT NULL,
  `product_id_id` int(11) NOT NULL,
  `input_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stock_input`
--

INSERT INTO `stock_input` (`id`, `color_id_id`, `size_id_id`, `product_id_id`, `input_date`, `quantity`, `created_date`) VALUES
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

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `address_billing_id_id` int(11) NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `is_active` smallint(6) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `address_billing_id_id`, `username`, `firstname`, `lastname`, `email`, `password`, `phone`, `roles`, `is_active`, `created_date`) VALUES
(1, 1, 'Aembett', 'Akim', 'Embett', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0621524185', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 0, '2018-12-14 11:00:00'),
(2, 2, 'Bglace', 'Brice', 'Glace', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0685968574', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 0, '2018-12-14 11:00:00'),
(3, 3, 'Gtar', 'Guy', 'Tar', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0758932145', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 0, '2018-12-14 11:00:00'),
(4, 4, 'Jcelert', 'Jacques', 'Célert', 'wf3tshirt@gmail.com', '$2y$13$Us8zdLD3IDa9HFZGIH9bYOm27Dr6EDD\\/OxQ5MML.qFGldRn6FegFq', '0682829206', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 0, '2018-12-14 11:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F5299398F052D342` (`address_billing_id_id`),
  ADD UNIQUE KEY `UNIQ_F529939847C7A933` (`address_delivery_id_id`);

--
-- Index pour la table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9CE58EE1FCDAEAAA` (`order_id_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_input`
--
ALTER TABLE `stock_input`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F052D342` (`address_billing_id_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `stock_input`
--
ALTER TABLE `stock_input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_F529939847C7A933` FOREIGN KEY (`address_delivery_id_id`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `FK_F5299398F052D342` FOREIGN KEY (`address_billing_id_id`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `FK_9CE58EE1FCDAEAAA` FOREIGN KEY (`order_id_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD6F7F214C` FOREIGN KEY (`gender_id_id`) REFERENCES `gender` (`id`),
  ADD CONSTRAINT `FK_D34A04ADE22F468B` FOREIGN KEY (`product_type_id_id`) REFERENCES `product_type` (`id`),
  ADD CONSTRAINT `FK_D34A04ADEF048774` FOREIGN KEY (`rate_id_id`) REFERENCES `rate` (`id`);

--
-- Contraintes pour la table `stock_input`
--
ALTER TABLE `stock_input`
  ADD CONSTRAINT `FK_44382E26AE945C60` FOREIGN KEY (`size_id_id`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `FK_44382E26DE18E50B` FOREIGN KEY (`product_id_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_44382E26E88CCE5` FOREIGN KEY (`color_id_id`) REFERENCES `color` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649F052D342` FOREIGN KEY (`address_billing_id_id`) REFERENCES `address` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
