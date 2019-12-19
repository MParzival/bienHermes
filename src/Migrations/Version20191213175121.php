<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213175121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actuality (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, resume LONGTEXT NOT NULL, date_parution DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien_hermes CHANGE TypeTransact TypeTransact SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE actuality');
        $this->addSql('ALTER TABLE bien_hermes CHANGE TypeTransact TypeTransact TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE property_alert MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE property_alert DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_alert CHANGE id id INT NOT NULL');
    }
}
