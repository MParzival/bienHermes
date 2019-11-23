<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123160256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE alert_bien_hermes');
        $this->addSql('DROP TABLE property_alert');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alert_bien_hermes (alert_id INT NOT NULL, bien_hermes_id INT UNSIGNED NOT NULL, INDEX IDX_2B5D792593035F72 (alert_id), INDEX IDX_2B5D7925CE57229E (bien_hermes_id), PRIMARY KEY(alert_id, bien_hermes_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE property_alert (id INT AUTO_INCREMENT NOT NULL, bien_id INT UNSIGNED DEFAULT NULL, alert_id INT DEFAULT NULL, sended_at DATETIME NOT NULL, INDEX IDX_D1EE87CC93035F72 (alert_id), INDEX IDX_D1EE87CCBD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alert_bien_hermes ADD CONSTRAINT FK_2B5D792593035F72 FOREIGN KEY (alert_id) REFERENCES alert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alert_bien_hermes ADD CONSTRAINT FK_2B5D7925CE57229E FOREIGN KEY (bien_hermes_id) REFERENCES bien_hermes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CC93035F72 FOREIGN KEY (alert_id) REFERENCES alert (id)');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CCBD95B80F FOREIGN KEY (bien_id) REFERENCES bien_hermes (id)');
    }
}
