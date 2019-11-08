<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107160143 extends AbstractMigration
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

        $this->addSql('ALTER TABLE bien_hermes DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE bien_hermes CHANGE Numero Numero INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE Statut Statut TINYINT(1) DEFAULT \'0\', CHANGE DateRetrait DateRetrait DATE DEFAULT NULL, CHANGE Top Top TINYINT(1) DEFAULT \'0\', CHANGE TypeTransact TypeTransact TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE Denomination Denomination VARCHAR(40) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, CHANGE Activite Activite VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, CHANGE Licence Licence TINYINT(1) DEFAULT NULL, CHANGE Categorie Categorie CHAR(2) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, CHANGE Divisible Divisible TINYINT(1) DEFAULT NULL, CHANGE Despecialisation Despecialisation TINYINT(1) DEFAULT NULL, CHANGE MachCafeDepot MachCafeDepot TINYINT(1) DEFAULT \'0\', CHANGE VisitCounter VisitCounter SMALLINT UNSIGNED DEFAULT 0, CHANGE bNaxos bNaxos TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE NonSoumisDPE NonSoumisDPE TINYINT(1) DEFAULT \'0\', CHANGE DPEenCours DPEenCours TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE bien_hermes ADD PRIMARY KEY (CodeReseau, CodeAgence, Numero)');
    }
}
