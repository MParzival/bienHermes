<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206092215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien_hermes ADD lat DOUBLE PRECISION NOT NULL, ADD lng DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE alert_user CHANGE id_activity_id id_activity_id INT DEFAULT NULL, CHANGE id_user_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CC393D7457 FOREIGN KEY (alert_user_id) REFERENCES alert_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert_user CHANGE id_activity_id id_activity_id INT NOT NULL, CHANGE id_user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE bien_hermes DROP lat, DROP lng');
        $this->addSql('ALTER TABLE property_alert DROP FOREIGN KEY FK_D1EE87CC393D7457');
    }
}
