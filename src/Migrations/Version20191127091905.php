<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127091905 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
       /* $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property_alert (id INT AUTO_INCREMENT NOT NULL, bien_id INT UNSIGNED DEFAULT NULL, alert_user_id INT DEFAULT NULL, is_sent TINYINT(1) NOT NULL, INDEX IDX_D1EE87CCBD95B80F (bien_id), INDEX IDX_D1EE87CC393D7457 (alert_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CCBD95B80F FOREIGN KEY (bien_id) REFERENCES bien_hermes (id)');
        $this->addSql('ALTER TABLE property_alert ADD CONSTRAINT FK_D1EE87CC393D7457 FOREIGN KEY (alert_user_id) REFERENCES alert_user (id)');
        $this->addSql('ALTER TABLE alert_user MODIFY id_Alert INT NOT NULL');
        $this->addSql('ALTER TABLE alert_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert_user CHANGE id_alert id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert_user ADD PRIMARY KEY (id)');*/
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE property_alert');
        $this->addSql('ALTER TABLE alert_user MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE alert_user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE alert_user CHANGE id id_Alert INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE alert_user ADD PRIMARY KEY (id_Alert)');
    }
}
