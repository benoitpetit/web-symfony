-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema devmyshirts
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `devmyshirts` ;

-- -----------------------------------------------------
-- Schema devmyshirts
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `devmyshirts` DEFAULT CHARACTER SET utf8 ;
USE `devmyshirts` ;

-- -----------------------------------------------------
-- Table `devmyshirts`.`gender`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`gender` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`gender` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `men` VARCHAR(45) NOT NULL,
  `women` VARCHAR(45) NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`product_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`product_type` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`product_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_type` VARCHAR(45) NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`rate`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`rate` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`rate` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rate_datestart` DATETIME NOT NULL,
  `rate_dateend` DATETIME NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`color`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`color` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`color` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `color_name` VARCHAR(45) NOT NULL,
  `color_hexa` VARCHAR(45) NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`logo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`logo` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`logo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logo_name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`size`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`size` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`size` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `size` VARCHAR(45) NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`address`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`address` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `address_type` VARCHAR(45) NOT NULL DEFAULT '@BILLING',
  `street` VARCHAR(255) NOT NULL,
  `zip_code` VARCHAR(50) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `country` VARCHAR(255) NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`users` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `phone` DECIMAL NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` LONGTEXT NOT NULL COMMENT '(DC2Type:array)',
  `is_active` TINYINT(1) NOT NULL DEFAULT 0,
  `address_billing_id` INT NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_address1`
    FOREIGN KEY (`address_billing_id`)
    REFERENCES `devmyshirts`.`address` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `devmyshirts`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`order` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`order` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order_register` VARCHAR(50) NOT NULL,
  `order_date` DATETIME NOT NULL DEFAULT NOW(),
  `address_billing_id` INT NOT NULL,
  `address_delivery_id` INT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_order_address1`
    FOREIGN KEY (`address_billing_id`)
    REFERENCES `devmyshirts`.`address` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_address2`
    FOREIGN KEY (`address_delivery_id`)
    REFERENCES `devmyshirts`.`address` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`order_line`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`order_line` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`order_line` (
  `order_id` INT NOT NULL COMMENT 'Order number',
  `order_line_id` INT NOT NULL COMMENT 'Order number line (1->max)',
  `product_id` INT NOT NULL COMMENT 'Product number (product)',
  `product_color_id` INT NOT NULL COMMENT 'color identifiant',
  `product_logo_id` INT NOT NULL COMMENT 'logo  identifiant',
  `product_size_id` INT NOT NULL COMMENT 'size identifiant',
  `product_gender_id` INT NOT NULL COMMENT 'gender  identifiant',
  `quantity` INT NOT NULL COMMENT 'Quantity par product',
  `price_unit_ht` FLOAT NOT NULL,
  `promo_unit_ht` FLOAT NULL COMMENT 'promotion (see to table Event - Dynamic SQL ?!?)',
  `rate_id` INT NOT NULL COMMENT 'rate for instant t',
  `price_total_ttc` FLOAT NOT NULL COMMENT 'total price ttc for this product and quantity and promo',
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`order_id`, `order_line_id`),
  CONSTRAINT `fk_order_line_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `devmyshirts`.`order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `devmyshirts`.`stock_input`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`stock_input` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`stock_input` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `input_date` DATETIME NOT NULL,
  `quantity` INT NOT NULL,
  `product_id` INT NOT NULL,
  `product_gender_id` INT NOT NULL,
  `color_id` INT NOT NULL,
  `size_id` INT NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`, `product_id`, `product_gender_id`, `color_id`, `size_id`),
  CONSTRAINT `fk_stock_input_product1`
    FOREIGN KEY (`product_id` , `product_gender_id`)
    REFERENCES `devmyshirts`.`product` (`id` , `gender_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_input_color1`
    FOREIGN KEY (`color_id`)
    REFERENCES `devmyshirts`.`color` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_input_size1`
    FOREIGN KEY (`size_id`)
    REFERENCES `devmyshirts`.`size` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `devmyshirts`.`product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `devmyshirts`.`product` ;

CREATE TABLE IF NOT EXISTS `devmyshirts`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `price_unit_ht` FLOAT NOT NULL,
  `gender_id` INT NOT NULL,
  `product_type_id` INT NOT NULL,
  `rate_id` INT NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`, `gender_id`, `product_type_id`, `rate_id`),
  CONSTRAINT `fk_product_gender1`
    FOREIGN KEY (`gender_id`)
    REFERENCES `devmyshirts`.`gender` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_product_type1`
    FOREIGN KEY (`product_type_id`)
    REFERENCES `devmyshirts`.`product_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_rate1`
    FOREIGN KEY (`rate_id`)
    REFERENCES `devmyshirts`.`rate` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
