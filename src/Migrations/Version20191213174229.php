<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213174229 extends AbstractMigration
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

        $this->addSql('CREATE TABLE mon_entite (id INT AUTO_INCREMENT NOT NULL, nom_de_mon_entite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE actuality');
        $this->addSql('ALTER TABLE bien_hermes ADD mon_entite_id INT DEFAULT NULL, CHANGE TypeTransact TypeTransact TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE bien_hermes ADD CONSTRAINT FK_AD0FA4992B33EEF4 FOREIGN KEY (mon_entite_id) REFERENCES mon_entite (id)');
        $this->addSql('CREATE INDEX IDX_AD0FA4992B33EEF4 ON bien_hermes (mon_entite_id)');
        $this->addSql('ALTER TABLE property_alert MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE property_alert DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_alert ADD idProperty INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE user DROP is_nego, CHANGE roles roles JSON NOT NULL');
    }
}
