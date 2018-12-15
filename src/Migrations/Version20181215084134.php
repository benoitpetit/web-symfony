<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181215084134 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address_type VARCHAR(45) NOT NULL, street VARCHAR(255) NOT NULL, zip_code VARCHAR(45) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, color_name VARCHAR(45) NOT NULL, color_hexa VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo (id INT AUTO_INCREMENT NOT NULL, logo_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_line (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id INT NOT NULL, product_color_id INT NOT NULL, product_logo_id INT NOT NULL, product_size_id INT NOT NULL, product_gender_id INT NOT NULL, quantity INT NOT NULL, price_unit_ht DOUBLE PRECISION NOT NULL, promo_unit_ht DOUBLE PRECISION DEFAULT NULL, rate_id INT NOT NULL, price_total_ttc DOUBLE PRECISION NOT NULL, created_date DATETIME NOT NULL, INDEX IDX_9CE58EE1FCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, address_billing_id_id INT NOT NULL, address_delivery_id_id INT DEFAULT NULL, order_register VARCHAR(50) NOT NULL, order_date DATETIME NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_E52FFDEEF052D342 (address_billing_id_id), UNIQUE INDEX UNIQ_E52FFDEE47C7A933 (address_delivery_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_type_id_id INT NOT NULL, rate_id_id INT NOT NULL, gender_id_id INT NOT NULL, price_unit_ht DOUBLE PRECISION NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_D34A04ADE22F468B (product_type_id_id), UNIQUE INDEX UNIQ_D34A04ADEF048774 (rate_id_id), INDEX IDX_D34A04AD6F7F214C (gender_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_type (id INT AUTO_INCREMENT NOT NULL, product_type VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, rate_date_start DATETIME NOT NULL, rate_date_end DATETIME DEFAULT NULL, rate DOUBLE PRECISION DEFAULT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, size VARCHAR(45) NOT NULL, created_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_input (id INT AUTO_INCREMENT NOT NULL, color_id_id INT NOT NULL, size_id_id INT NOT NULL, product_id_id INT NOT NULL, input_date DATETIME NOT NULL, quantity INT NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_44382E26E88CCE5 (color_id_id), UNIQUE INDEX UNIQ_44382E26AE945C60 (size_id_id), UNIQUE INDEX UNIQ_44382E26DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_billing_id_id INT DEFAULT NULL, username VARCHAR(45) NOT NULL, firstname VARCHAR(45) NOT NULL, lastname VARCHAR(45) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(45) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', is_active SMALLINT NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F052D342 (address_billing_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        // $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEF052D342 FOREIGN KEY (address_billing_id_id) REFERENCES address (id)');
        // $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE47C7A933 FOREIGN KEY (address_delivery_id_id) REFERENCES address (id)');
        // $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE22F468B FOREIGN KEY (product_type_id_id) REFERENCES product_type (id)');
        // $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEF048774 FOREIGN KEY (rate_id_id) REFERENCES rate (id)');
        // $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6F7F214C FOREIGN KEY (gender_id_id) REFERENCES gender (id)');
        // $this->addSql('ALTER TABLE stock_input ADD CONSTRAINT FK_44382E26E88CCE5 FOREIGN KEY (color_id_id) REFERENCES color (id)');
        // $this->addSql('ALTER TABLE stock_input ADD CONSTRAINT FK_44382E26AE945C60 FOREIGN KEY (size_id_id) REFERENCES size (id)');
        // $this->addSql('ALTER TABLE stock_input ADD CONSTRAINT FK_44382E26DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        // $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F052D342 FOREIGN KEY (address_billing_id_id) REFERENCES address (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEF052D342');
        // $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE47C7A933');
        // $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F052D342');
        // $this->addSql('ALTER TABLE stock_input DROP FOREIGN KEY FK_44382E26E88CCE5');
        // $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6F7F214C');
        // $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        // $this->addSql('ALTER TABLE stock_input DROP FOREIGN KEY FK_44382E26DE18E50B');
        // $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE22F468B');
        // $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEF048774');
        // $this->addSql('ALTER TABLE stock_input DROP FOREIGN KEY FK_44382E26AE945C60');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE logo');
        $this->addSql('DROP TABLE order_line');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_type');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE stock_input');
        $this->addSql('DROP TABLE user');
    }
}
