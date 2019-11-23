<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123143833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1CD846B36');
        $this->addSql('DROP INDEX IDX_17FD46C1CD846B36 ON alert');
        $this->addSql('ALTER TABLE alert DROP property_alert_id');
        $this->addSql('ALTER TABLE bien_hermes DROP FOREIGN KEY FK_AD0FA499CD846B36');
        $this->addSql('DROP INDEX IDX_AD0FA499CD846B36 ON bien_hermes');
        $this->addSql('ALTER TABLE bien_hermes DROP property_alert_id');
        $this->addSql('ALTER TABLE property_alert ADD bien_id INT UNSIGNED DEFAULT NULL, ADD alert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CCBD95B80F FOREIGN KEY (bien_id) REFERENCES bien_hermes (id)');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CC93035F72 FOREIGN KEY (alert_id) REFERENCES alert (id)');
        $this->addSql('CREATE INDEX IDX_D1EE87CCBD95B80F ON property_alert (bien_id)');
        $this->addSql('CREATE INDEX IDX_D1EE87CC93035F72 ON property_alert (alert_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert ADD property_alert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1CD846B36 FOREIGN KEY (property_alert_id) REFERENCES property_alert (id)');
        $this->addSql('CREATE INDEX IDX_17FD46C1CD846B36 ON alert (property_alert_id)');
        $this->addSql('ALTER TABLE bien_hermes ADD property_alert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien_hermes ADD CONSTRAINT FK_AD0FA499CD846B36 FOREIGN KEY (property_alert_id) REFERENCES property_alert (id)');
        $this->addSql('CREATE INDEX IDX_AD0FA499CD846B36 ON bien_hermes (property_alert_id)');
        $this->addSql('ALTER TABLE property_alert DROP FOREIGN KEY FK_D1EE87CCBD95B80F');
        $this->addSql('ALTER TABLE property_alert DROP FOREIGN KEY FK_D1EE87CC93035F72');
        $this->addSql('DROP INDEX IDX_D1EE87CCBD95B80F ON property_alert');
        $this->addSql('DROP INDEX IDX_D1EE87CC93035F72 ON property_alert');
        $this->addSql('ALTER TABLE property_alert DROP bien_id, DROP alert_id');
    }
}
