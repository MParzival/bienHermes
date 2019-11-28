<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127100142 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert_user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE alert_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert_user CHANGE id id_Alert INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert_user ADD PRIMARY KEY (id_Alert)');
        $this->addSql('ALTER TABLE property_alert DROP FOREIGN KEY FK_D1EE87CC393D7457');
        $this->addSql('ALTER TABLE user DROP name, DROP lastname');
    }
}
