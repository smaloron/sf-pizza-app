<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220321090808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, unit_price INT NOT NULL, calories INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza (id INT AUTO_INCREMENT NOT NULL, size_id INT NOT NULL, base_id INT NOT NULL, creator_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CFDD826F498DA827 (size_id), INDEX IDX_CFDD826F6967DF41 (base_id), INDEX IDX_CFDD826F61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_ingredient (pizza_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_6FF6C03FD41D1D42 (pizza_id), INDEX IDX_6FF6C03F933FE08C (ingredient_id), PRIMARY KEY(pizza_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_base (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_cart (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, UNIQUE INDEX UNIQ_72AAD4F619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_cart_item (id INT AUTO_INCREMENT NOT NULL, shopping_cart_id INT DEFAULT NULL, pizza_id INT DEFAULT NULL, qt INT NOT NULL, INDEX IDX_E59A1DF445F80CD (shopping_cart_id), INDEX IDX_E59A1DF4D41D1D42 (pizza_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826F498DA827 FOREIGN KEY (size_id) REFERENCES pizza_size (id)');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826F6967DF41 FOREIGN KEY (base_id) REFERENCES pizza_base (id)');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826F61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE pizza_ingredient ADD CONSTRAINT FK_6FF6C03FD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_ingredient ADD CONSTRAINT FK_6FF6C03F933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_cart ADD CONSTRAINT FK_72AAD4F619EB6921 FOREIGN KEY (client_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE shopping_cart_item ADD CONSTRAINT FK_E59A1DF445F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id)');
        $this->addSql('ALTER TABLE shopping_cart_item ADD CONSTRAINT FK_E59A1DF4D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pizza_ingredient DROP FOREIGN KEY FK_6FF6C03F933FE08C');
        $this->addSql('ALTER TABLE pizza_ingredient DROP FOREIGN KEY FK_6FF6C03FD41D1D42');
        $this->addSql('ALTER TABLE shopping_cart_item DROP FOREIGN KEY FK_E59A1DF4D41D1D42');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826F6967DF41');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826F498DA827');
        $this->addSql('ALTER TABLE shopping_cart_item DROP FOREIGN KEY FK_E59A1DF445F80CD');
        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826F61220EA6');
        $this->addSql('ALTER TABLE shopping_cart DROP FOREIGN KEY FK_72AAD4F619EB6921');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE pizza_ingredient');
        $this->addSql('DROP TABLE pizza_base');
        $this->addSql('DROP TABLE pizza_size');
        $this->addSql('DROP TABLE shopping_cart');
        $this->addSql('DROP TABLE shopping_cart_item');
        $this->addSql('DROP TABLE `user`');
    }
}
