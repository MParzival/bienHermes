<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121163354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE criteria_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, activity_id INT DEFAULT NULL, max_price INT NOT NULL, postal_code VARCHAR(5) NOT NULL, INDEX IDX_9394B4A6A76ED395 (user_id), INDEX IDX_9394B4A681C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_property_by_user (id INT AUTO_INCREMENT NOT NULL, bien_id INT UNSIGNED DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_59D998D2BD95B80F (bien_id), INDEX IDX_59D998D2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE criteria_user ADD CONSTRAINT FK_9394B4A6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE criteria_user ADD CONSTRAINT FK_9394B4A681C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE list_property_by_user ADD CONSTRAINT FK_59D998D2BD95B80F FOREIGN KEY (bien_id) REFERENCES bien_hermes (id)');
        $this->addSql('ALTER TABLE list_property_by_user ADD CONSTRAINT FK_59D998D2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE wish_list');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, activity_id INT DEFAULT NULL, max_price INT NOT NULL, postal_code VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_17FD46C181C06096 (activity_id), INDEX IDX_17FD46C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wish_list (id INT AUTO_INCREMENT NOT NULL, bien_id INT UNSIGNED DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_5B8739BDA76ED395 (user_id), INDEX IDX_5B8739BDBD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C181C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BDBD95B80F FOREIGN KEY (bien_id) REFERENCES bien_hermes (id)');
        $this->addSql('DROP TABLE criteria_user');
        $this->addSql('DROP TABLE list_property_by_user');
    }
}
