<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113094558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE goods_category DROP FOREIGN KEY FK_7818331212469DE2');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4B7683595');
        $this->addSql('ALTER TABLE goods_category DROP FOREIGN KEY FK_78183312B7683595');
        $this->addSql('ALTER TABLE goods_keyword DROP FOREIGN KEY FK_BFC51F36B7683595');
        $this->addSql('ALTER TABLE goods_keyword DROP FOREIGN KEY FK_BFC51F36115D4552');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE goods');
        $this->addSql('DROP TABLE goods_category');
        $this->addSql('DROP TABLE goods_keyword');
        $this->addSql('DROP TABLE keyword');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, goods_id INT NOT NULL, content LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, active TINYINT(1) NOT NULL, mail VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nickname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, rgpd TINYINT(1) NOT NULL, INDEX IDX_D9BEC0C4B7683595 (goods_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE goods (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, featured_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_563B92D67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE goods_category (goods_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_78183312B7683595 (goods_id), INDEX IDX_7818331212469DE2 (category_id), PRIMARY KEY(goods_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE goods_keyword (goods_id INT NOT NULL, keyword_id INT NOT NULL, INDEX IDX_BFC51F36B7683595 (goods_id), INDEX IDX_BFC51F36115D4552 (keyword_id), PRIMARY KEY(goods_id, keyword_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE keyword (id INT AUTO_INCREMENT NOT NULL, keyword VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id)');
        $this->addSql('ALTER TABLE goods ADD CONSTRAINT FK_563B92D67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE goods_category ADD CONSTRAINT FK_7818331212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_category ADD CONSTRAINT FK_78183312B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_keyword ADD CONSTRAINT FK_BFC51F36115D4552 FOREIGN KEY (keyword_id) REFERENCES keyword (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_keyword ADD CONSTRAINT FK_BFC51F36B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE');
    }
}
