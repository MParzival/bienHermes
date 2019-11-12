<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191112135633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE goods_keyword (goods_id INT NOT NULL, keyword_id INT NOT NULL, INDEX IDX_BFC51F36B7683595 (goods_id), INDEX IDX_BFC51F36115D4552 (keyword_id), PRIMARY KEY(goods_id, keyword_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goods_categories (goods_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_4B5D6736B7683595 (goods_id), INDEX IDX_4B5D6736A21214B7 (categories_id), PRIMARY KEY(goods_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goods_keyword ADD CONSTRAINT FK_BFC51F36B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_keyword ADD CONSTRAINT FK_BFC51F36115D4552 FOREIGN KEY (keyword_id) REFERENCES keyword (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_categories ADD CONSTRAINT FK_4B5D6736B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE goods_categories ADD CONSTRAINT FK_4B5D6736A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE goods_keyword');
        $this->addSql('DROP TABLE goods_categories');
    }
}
