<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191112154715 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE goods_categories DROP FOREIGN KEY FK_4B5D6736A21214B7');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goods_category (goods_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_78183312B7683595 (goods_id), INDEX IDX_7818331212469DE2 (category_id), PRIMARY KEY(goods_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goods_category ADD CONSTRAINT FK_78183312B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_category ADD CONSTRAINT FK_7818331212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE goods_categories');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE goods_category DROP FOREIGN KEY FK_7818331212469DE2');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE goods_categories (goods_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_4B5D6736B7683595 (goods_id), INDEX IDX_4B5D6736A21214B7 (categories_id), PRIMARY KEY(goods_id, categories_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE goods_categories ADD CONSTRAINT FK_4B5D6736A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_categories ADD CONSTRAINT FK_4B5D6736B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE goods_category');
    }
}
