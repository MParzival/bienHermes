<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127085722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
       /* $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert_user ADD id_activity_id INT DEFAULT NULL, ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert_user ADD CONSTRAINT FK_22304CD99D2AD61 FOREIGN KEY (id_activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE alert_user ADD CONSTRAINT FK_22304CD79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_22304CD99D2AD61 ON alert_user (id_activity_id)');
        $this->addSql('CREATE INDEX IDX_22304CD79F37AE5 ON alert_user (id_user_id)');*/
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alert_user DROP FOREIGN KEY FK_22304CD99D2AD61');
        $this->addSql('ALTER TABLE alert_user DROP FOREIGN KEY FK_22304CD79F37AE5');
        $this->addSql('DROP INDEX IDX_22304CD99D2AD61 ON alert_user');
        $this->addSql('DROP INDEX IDX_22304CD79F37AE5 ON alert_user');
        $this->addSql('ALTER TABLE alert_user DROP id_activity_id, DROP id_user_id');
    }
}
