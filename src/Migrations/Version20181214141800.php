<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181214141800 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, address_billing_id_id INT NOT NULL, address_delivery_id_id INT DEFAULT NULL, order_register VARCHAR(50) NOT NULL, order_date DATETIME NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_E52FFDEEF052D342 (address_billing_id_id), UNIQUE INDEX UNIQ_E52FFDEE47C7A933 (address_delivery_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEF052D342 FOREIGN KEY (address_billing_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE47C7A933 FOREIGN KEY (address_delivery_id_id) REFERENCES address (id)');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE product DROP INDEX IDX_D34A04ADE22F468B, ADD UNIQUE INDEX UNIQ_D34A04ADE22F468B (product_type_id_id)');
        $this->addSql('ALTER TABLE product DROP INDEX IDX_D34A04ADEF048774, ADD UNIQUE INDEX UNIQ_D34A04ADEF048774 (rate_id_id)');
        $this->addSql('ALTER TABLE stock_input DROP INDEX IDX_44382E26AE945C60, ADD UNIQUE INDEX UNIQ_44382E26AE945C60 (size_id_id)');
        $this->addSql('ALTER TABLE stock_input DROP INDEX IDX_44382E26DE18E50B, ADD UNIQUE INDEX UNIQ_44382E26DE18E50B (product_id_id)');
        $this->addSql('ALTER TABLE stock_input DROP INDEX IDX_44382E26E88CCE5, ADD UNIQUE INDEX UNIQ_44382E26E88CCE5 (color_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, address_billing_id_id INT NOT NULL, address_delivery_id_id INT DEFAULT NULL, order_register VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, order_date DATETIME NOT NULL, created_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_F5299398F052D342 (address_billing_id_id), UNIQUE INDEX UNIQ_F529939847C7A933 (address_delivery_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939847C7A933 FOREIGN KEY (address_delivery_id_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F052D342 FOREIGN KEY (address_billing_id_id) REFERENCES address (id)');
        $this->addSql('DROP TABLE orders');
        $this->addSql('ALTER TABLE order_line DROP FOREIGN KEY FK_9CE58EE1FCDAEAAA');
        $this->addSql('ALTER TABLE order_line ADD CONSTRAINT FK_9CE58EE1FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product DROP INDEX UNIQ_D34A04ADE22F468B, ADD INDEX IDX_D34A04ADE22F468B (product_type_id_id)');
        $this->addSql('ALTER TABLE product DROP INDEX UNIQ_D34A04ADEF048774, ADD INDEX IDX_D34A04ADEF048774 (rate_id_id)');
        $this->addSql('ALTER TABLE stock_input DROP INDEX UNIQ_44382E26E88CCE5, ADD INDEX IDX_44382E26E88CCE5 (color_id_id)');
        $this->addSql('ALTER TABLE stock_input DROP INDEX UNIQ_44382E26AE945C60, ADD INDEX IDX_44382E26AE945C60 (size_id_id)');
        $this->addSql('ALTER TABLE stock_input DROP INDEX UNIQ_44382E26DE18E50B, ADD INDEX IDX_44382E26DE18E50B (product_id_id)');
    }
}
