<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107163144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('ALTER TABLE bien_hermes CHANGE Numero Numero INT UNSIGNED NOT NULL, CHANGE DateEntree DateEntree VARCHAR(255) DEFAULT \'0000-00-00\' NOT NULL, CHANGE DateUpdate DateUpdate VARCHAR(255) DEFAULT NULL, CHANGE Statut Statut TINYINT(1) DEFAULT NULL, CHANGE DateRetrait DateRetrait VARCHAR(255) DEFAULT NULL, CHANGE Top Top TINYINT(1) DEFAULT NULL, CHANGE TypeTransact TypeTransact TINYINT(1) NOT NULL, CHANGE Denomination Denomination VARCHAR(40) NOT NULL, CHANGE Activite Activite VARCHAR(100) NOT NULL, CHANGE Licence Licence TINYINT(1) DEFAULT NULL, CHANGE Categorie Categorie CHAR(2) NOT NULL, CHANGE DateFinBail DateFinBail VARCHAR(255) DEFAULT NULL, CHANGE Divisible Divisible TINYINT(1) DEFAULT NULL, CHANGE Despecialisation Despecialisation TINYINT(1) DEFAULT NULL, CHANGE MachCafeDepot MachCafeDepot TINYINT(1) DEFAULT NULL, CHANGE VisitCounter VisitCounter SMALLINT UNSIGNED DEFAULT NULL, CHANGE bNaxos bNaxos TINYINT(1) NOT NULL, CHANGE TenuDepuis TenuDepuis VARCHAR(255) DEFAULT NULL, CHANGE DateLiberation DateLiberation VARCHAR(255) DEFAULT NULL, CHANGE DateDPE DateDPE VARCHAR(255) DEFAULT NULL, CHANGE DateGES DateGES VARCHAR(255) DEFAULT NULL, CHANGE NonSoumisDPE NonSoumisDPE TINYINT(1) DEFAULT NULL, CHANGE DPEenCours DPEenCours TINYINT(1) DEFAULT NULL, CHANGE DateDebutMandat DateDebutMandat VARCHAR(255) DEFAULT NULL, CHANGE DateFinMandat DateFinMandat VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (Numero)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien_hermes DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE bien_hermes CHANGE Numero Numero INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE DateEntree DateEntree VARCHAR(20) DEFAULT \'0000-00-00\' NOT NULL COLLATE latin1_swedish_ci, CHANGE DateUpdate DateUpdate VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE Statut Statut TINYINT(1) DEFAULT \'0\', CHANGE DateRetrait DateRetrait VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE Top Top TINYINT(1) DEFAULT \'0\', CHANGE TypeTransact TypeTransact TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE Denomination Denomination VARCHAR(40) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, CHANGE Activite Activite VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, CHANGE Licence Licence TINYINT(1) DEFAULT NULL, CHANGE Categorie Categorie CHAR(2) DEFAULT \'\' NOT NULL COLLATE latin1_swedish_ci, CHANGE DateFinBail DateFinBail VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE Divisible Divisible TINYINT(1) DEFAULT NULL, CHANGE Despecialisation Despecialisation TINYINT(1) DEFAULT NULL, CHANGE MachCafeDepot MachCafeDepot TINYINT(1) DEFAULT \'0\', CHANGE VisitCounter VisitCounter SMALLINT UNSIGNED DEFAULT 0, CHANGE bNaxos bNaxos TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE TenuDepuis TenuDepuis VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE DateLiberation DateLiberation VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE DateDPE DateDPE VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE DateGES DateGES VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE NonSoumisDPE NonSoumisDPE TINYINT(1) DEFAULT \'0\', CHANGE DPEenCours DPEenCours TINYINT(1) DEFAULT \'0\', CHANGE DateDebutMandat DateDebutMandat VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE DateFinMandat DateFinMandat VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci');
    }
}
