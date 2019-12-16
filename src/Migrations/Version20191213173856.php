<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213173856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actuality DROP filename, DROP resume, DROP date_parution, DROP updated_at');
        $this->addSql('ALTER TABLE bien_hermes ADD lat DOUBLE PRECISION NOT NULL, ADD lng DOUBLE PRECISION NOT NULL, CHANGE TypeTransact TypeTransact TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE property_alert MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE property_alert DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_alert CHANGE id idProperty INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE property_alert ADD PRIMARY KEY (idProperty)');
        $this->addSql('ALTER TABLE user DROP is_nego, CHANGE roles roles JSON NOT NULL');
    }
}
