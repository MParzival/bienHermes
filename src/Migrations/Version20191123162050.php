<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123162050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien_hermes ADD alert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien_hermes ADD CONSTRAINT FK_AD0FA49993035F72 FOREIGN KEY (alert_id) REFERENCES alert (id)');
        $this->addSql('CREATE INDEX IDX_AD0FA49993035F72 ON bien_hermes (alert_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien_hermes DROP FOREIGN KEY FK_AD0FA49993035F72');
        $this->addSql('DROP INDEX IDX_AD0FA49993035F72 ON bien_hermes');
        $this->addSql('ALTER TABLE bien_hermes DROP alert_id');
    }
}
