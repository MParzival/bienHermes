<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127085001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        /*$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');*/

       /* $this->addSql('ALTER TABLE alert_user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE alert_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert_user CHANGE id id_alert INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert_user ADD PRIMARY KEY (id_alert)');*/
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert_user MODIFY id_alert INT NOT NULL');
        $this->addSql('ALTER TABLE alert_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert_user CHANGE id_alert id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert_user ADD PRIMARY KEY (id)');
    }
}
