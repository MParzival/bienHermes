<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127083549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        /*$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');*/


    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alert_bien (id INT AUTO_INCREMENT NOT NULL, bien_id INT UNSIGNED DEFAULT NULL, alert_id INT DEFAULT NULL, is_sent TINYINT(1) NOT NULL, INDEX IDX_CA5D110293035F72 (alert_id), INDEX IDX_CA5D1102BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alert_bien ADD CONSTRAINT FK_CA5D110293035F72 FOREIGN KEY (alert_id) REFERENCES alert (id)');
        $this->addSql('ALTER TABLE alert_bien ADD CONSTRAINT FK_CA5D1102BD95B80F FOREIGN KEY (bien_id) REFERENCES bien_hermes (id)');
        $this->addSql('ALTER TABLE alert MODIFY id_alert INT NOT NULL');
        $this->addSql('ALTER TABLE alert DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert CHANGE id_alert id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert ADD PRIMARY KEY (id)');
    }
}
