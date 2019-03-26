<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210134217 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vocabulaire CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF47EA05DB0');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF494F4A9D2');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4A70A18EC');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4F5D80971');
        $this->addSql('DROP INDEX IDX_FCF22AF4F5D80971 ON liste');
        $this->addSql('DROP INDEX IDX_FCF22AF4A70A18EC ON liste');
        $this->addSql('DROP INDEX IDX_FCF22AF47EA05DB0 ON liste');
        $this->addSql('DROP INDEX IDX_FCF22AF494F4A9D2 ON liste');
        $this->addSql('ALTER TABLE liste DROP tests_id, DROP entreprises_id, DROP vocabulaires_id, DROP themes_id');
        $this->addSql('ALTER TABLE entreprise CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD tests_id INT DEFAULT NULL, ADD entreprises_id INT DEFAULT NULL, ADD vocabulaires_id INT DEFAULT NULL, ADD themes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF47EA05DB0 FOREIGN KEY (vocabulaires_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF494F4A9D2 FOREIGN KEY (themes_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4A70A18EC FOREIGN KEY (entreprises_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4F5D80971 FOREIGN KEY (tests_id) REFERENCES test (id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4F5D80971 ON liste (tests_id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4A70A18EC ON liste (entreprises_id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF47EA05DB0 ON liste (vocabulaires_id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF494F4A9D2 ON liste (themes_id)');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE vocabulaire CHANGE liste_id liste_id INT DEFAULT NULL');
    }
}
