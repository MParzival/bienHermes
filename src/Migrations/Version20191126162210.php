<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126162210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
       /* $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');*/

        /*$this->addSql('ALTER TABLE alert MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE alert DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert CHANGE id id_alert INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert ADD PRIMARY KEY (id_alert)');
        $this->addSql('ALTER TABLE alert_bien DROP FOREIGN KEY FK_CA5D110293035F72');
        $this->addSql('DROP INDEX IDX_CA5D110293035F72 ON alert_bien');
        $this->addSql('ALTER TABLE alert_bien DROP alert_id');*/
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert MODIFY id_alert INT NOT NULL');
        $this->addSql('ALTER TABLE alert DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert CHANGE id_alert id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE alert_bien ADD alert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert_bien ADD CONSTRAINT FK_CA5D110293035F72 FOREIGN KEY (alert_id) REFERENCES alert (id)');
        $this->addSql('CREATE INDEX IDX_CA5D110293035F72 ON alert_bien (alert_id)');
    }
}
