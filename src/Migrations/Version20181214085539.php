<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181214085539 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('DROP SCHEMA `devmyshirts`');
        // $this->addSql('CREATE SCHEMA `devmyshirts` DEFAULT CHARACTER SET utf8');
        $this->addSql('USE `devmyshirts`');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address_type VARCHAR(45) NOT NULL, street VARCHAR(255) NOT NULL, zip_code VARCHAR(45) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, par_type_product VARCHAR(45) NOT NULL, color_name VARCHAR(45) NOT NULL, color_hexa VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, topic VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo (id INT AUTO_INCREMENT NOT NULL, par_type_product VARCHAR(45) NOT NULL, logo_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(200) NOT NULL, created_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, address_billing_id_id INT NOT NULL, address_delivery_id_id INT DEFAULT NULL, order_register VARCHAR(50) NOT NULL, order_date DATETIME NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_F5299398F052D342 (address_billing_id_id), UNIQUE INDEX UNIQ_F529939847C7A933 (address_delivery_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_line (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id INT NOT NULL, product_color_id INT NOT NULL, product_logo_id INT NOT NULL, product_size_id INT NOT NULL, product_gender_id INT NOT NULL, quantity INT NOT NULL, price_unit_ht DOUBLE PRECISION NOT NULL, promo_unit_ht DOUBLE PRECISION DEFAULT NULL, rate_id INT NOT NULL, price_total_ttc DOUBLE PRECISION NOT NULL, created_date DATETIME NOT NULL, INDEX IDX_9CE58EE1FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_type_id_id INT NOT NULL, rate_id_id INT NOT NULL, gender_id_id INT NOT NULL, price_unit_ht DOUBLE PRECISION NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_D34A04ADE22F468B (product_type_id_id), UNIQUE INDEX UNIQ_D34A04ADEF048774 (rate_id_id), INDEX IDX_D34A04AD6F7F214C (gender_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, product_type VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, rate FLOAT, rate_date_start DATETIME NOT NULL, rate_date_end DATETIME DEFAULT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, par_type_product VARCHAR(45) NOT NULL, size VARCHAR(45) NOT NULL, name VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_input (id INT AUTO_INCREMENT NOT NULL, color_id_id INT NOT NULL, size_id_id INT NOT NULL, product_id_id INT NOT NULL, input_date DATETIME NOT NULL, quantity INT NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_44382E26E88CCE5 (color_id_id), UNIQUE INDEX UNIQ_44382E26AE945C60 (size_id_id), UNIQUE INDEX UNIQ_44382E26DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_billing_id_id INT NOT NULL, username VARCHAR(45) NOT NULL, firstname VARCHAR(45) NOT NULL, lastname VARCHAR(45) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(45) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', is_active SMALLINT NOT NULL, reset_token VARCHAR(255), created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F052D342 (address_billing_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_F5299398F052D342 FOREIGN KEY (address_billing_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_F529939847C7A933 FOREIGN KEY (address_delivery_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `orders` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE22F468B FOREIGN KEY (product_type_id_id) REFERENCES product_type (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEF048774 FOREIGN KEY (rate_id_id) REFERENCES rate (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6F7F214C FOREIGN KEY (gender_id_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE stock_input ADD CONSTRAINT FK_44382E26E88CCE5 FOREIGN KEY (color_id_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE stock_input ADD CONSTRAINT FK_44382E26AE945C60 FOREIGN KEY (size_id_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE stock_input ADD CONSTRAINT FK_44382E26DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F052D342 FOREIGN KEY (address_billing_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('ALTER TABLE order_line DROP INDEX IDX_9CE58EE1FCDAEAAA');
        $this->addSql('CREATE VIEW vProduct_tshirt AS SELECT r.id rate_id, CAST(r.rate * 100 AS DECIMAL(5,2)) AS taux_tva, p.price_unit_ht, ROUND(p.price_unit_ht * r.rate) as price_tva, p.price_unit_ht + ROUND(p.price_unit_ht * r.rate) as price_unit_ttc, pt.id product_type_id, pt.product_type, g.id genre_id, g.name, c.id color_id, c.color_name, c.color_hexa, l.id logo_id, l.logo_name, l.slug FROM product p INNER JOIN rate r ON p.rate_id_id = r.id	INNER JOIN product_type pt ON p.product_type_id_id = pt.id INNER JOIN gender g ON p.gender_id_id = g.id, color c, logo l WHERE pt.id = 1 ORDER BY g.id, c.id, l.id');
<<<<<<< Updated upstream
=======
        $this->addSql('CREATE VIEW vOrders_tshirt AS SELECT u.id AS user_id, o.id, o.order_register, (SELECT SUM( ROUND((sol.price_unit_ht - COALESCE(promo_unit_ht, 0)) * (1 + sr.rate), 2)) AS price_ttc FROM user su INNER JOIN address sa ON su.address_billing_id_id = sa.id INNER JOIN orders so ON sa.id = so.address_billing_id_id INNER JOIN order_line sol ON so.id = sol.order_id_id INNER JOIN rate sr ON sol.rate_id = sr.id WHERE su.id = u.id AND so.id = o.id ) price_ttc, order_date FROM user u INNER JOIN address a ON u.address_billing_id_id = a.id INNER JOIN orders o ON a.id = o.address_billing_id_id');
        // $this->addSql('CREATE VIEW vOrderLines_tshirt AS SELECT u.id AS user_id, ol.order_id_id AS order_id, ol.product_type_id, pt.product_type, ol.product_gender_id, g.name as gender_name, ol.product_color_id, c.color_name, ol.product_size_id, s.size as size_name, CONCAT(s.size, ' - ', s.name) AS size_wording, ol.product_logo_id, l.logo_name, ol.quantity, ol.price_total_ttc FROM user u INNER JOIN address a ON (u.address_billing_id_id = a.id) INNER JOIN orders o ON (a.id = o.address_billing_id_id) INNER JOIN order_line ol ON (o.id = ol.order_id_id) INNER JOIN product_type pt ON (ol.product_type_id = pt.id) INNER JOIN gender g ON (ol.product_gender_id = g.id) INNER JOIN color c ON (ol.product_color_id = c.id AND c.par_type_product = \'@tshirt\') INNER JOIN size s ON (ol.product_size_id = s.id AND s.par_type_product = \'@tshirt\') INNER JOIN logo l ON (ol.product_logo_id = l.id AND l.par_type_product = \'@tshirt\'');
>>>>>>> Stashed changes
        // $this->addSql('CREATE TABLE migration_versions (version VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `orders` DROP FOREIGN KEY FK_F5299398F052D342');
        $this->addSql('ALTER TABLE `orders` DROP FOREIGN KEY FK_F529939847C7A933');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F052D342');
        $this->addSql('ALTER TABLE stock_input DROP FOREIGN KEY FK_44382E26E88CCE5');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6F7F214C');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('ALTER TABLE stock_input DROP FOREIGN KEY FK_44382E26DE18E50B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE22F468B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEF048774');
        $this->addSql('ALTER TABLE stock_input DROP FOREIGN KEY FK_44382E26AE945C60');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE logo');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE order_line');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_type');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE stock_input');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP VIEW vProduct_tshirt');
        $this->addSql('DROP VIEW vOrders_tshirt');
        // $this->addSql('DROP VIEW vOrderLines_tshirt');
        // $this->addSql('CREATE TABLE migration_versions');
        // $this->addSql('DROP SCHEMA `devmyshirts`');
    }
}
