<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210134002 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, tests_id INT DEFAULT NULL, entreprises_id INT DEFAULT NULL, vocabulaires_id INT DEFAULT NULL, themes_id INT DEFAULT NULL, INDEX IDX_FCF22AF4F5D80971 (tests_id), INDEX IDX_FCF22AF4A70A18EC (entreprises_id), INDEX IDX_FCF22AF47EA05DB0 (vocabulaires_id), INDEX IDX_FCF22AF494F4A9D2 (themes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4F5D80971 FOREIGN KEY (tests_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4A70A18EC FOREIGN KEY (entreprises_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF47EA05DB0 FOREIGN KEY (vocabulaires_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF494F4A9D2 FOREIGN KEY (themes_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vocabulaire ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vocabulaire ADD CONSTRAINT FK_DB1ADE7DE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_DB1ADE7DE85441D8 ON vocabulaire (liste_id)');
        $this->addSql('ALTER TABLE theme ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_9775E708E85441D8 ON theme (liste_id)');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_D19FA60E85441D8 ON entreprise (liste_id)');
        $this->addSql('ALTER TABLE test ADD liste_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CE85441D8 ON test (liste_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vocabulaire DROP FOREIGN KEY FK_DB1ADE7DE85441D8');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708E85441D8');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60E85441D8');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CE85441D8');
        $this->addSql('DROP TABLE liste');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_D19FA60E85441D8 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP liste_id');
        $this->addSql('DROP INDEX IDX_D87F7E0CE85441D8 ON test');
        $this->addSql('ALTER TABLE test DROP liste_id, CHANGE realiser_id realiser_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_9775E708E85441D8 ON theme');
        $this->addSql('ALTER TABLE theme DROP liste_id');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('DROP INDEX IDX_DB1ADE7DE85441D8 ON vocabulaire');
        $this->addSql('ALTER TABLE vocabulaire DROP liste_id');
    }
}
