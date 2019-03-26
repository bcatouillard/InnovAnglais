<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210144400 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vocabulaire DROP FOREIGN KEY FK_DB1ADE7DE85441D8');
        $this->addSql('DROP INDEX IDX_DB1ADE7DE85441D8 ON vocabulaire');
        $this->addSql('ALTER TABLE vocabulaire DROP liste_id');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708E85441D8');
        $this->addSql('DROP INDEX IDX_9775E708E85441D8 ON theme');
        $this->addSql('ALTER TABLE theme DROP liste_id');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD test_id INT DEFAULT NULL, ADD entreprise_id INT DEFAULT NULL, ADD vocabulaire_id INT DEFAULT NULL, ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF41E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4D8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF459027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF41E5D0459 ON liste (test_id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4A4AEAFEA ON liste (entreprise_id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF4D8B12F03 ON liste (vocabulaire_id)');
        $this->addSql('CREATE INDEX IDX_FCF22AF459027487 ON liste (theme_id)');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60E85441D8');
        $this->addSql('DROP INDEX IDX_D19FA60E85441D8 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP liste_id');
        $this->addSql('ALTER TABLE realiser ADD test_id INT DEFAULT NULL, CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D071E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('CREATE INDEX IDX_7BAB8D071E5D0459 ON realiser (test_id)');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CAC274FA8');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CE85441D8');
        $this->addSql('DROP INDEX IDX_D87F7E0CAC274FA8 ON test');
        $this->addSql('DROP INDEX IDX_D87F7E0CE85441D8 ON test');
        $this->addSql('ALTER TABLE test DROP realiser_id, DROP liste_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_D19FA60E85441D8 ON entreprise (liste_id)');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF41E5D0459');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4A4AEAFEA');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4D8B12F03');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF459027487');
        $this->addSql('DROP INDEX IDX_FCF22AF41E5D0459 ON liste');
        $this->addSql('DROP INDEX IDX_FCF22AF4A4AEAFEA ON liste');
        $this->addSql('DROP INDEX IDX_FCF22AF4D8B12F03 ON liste');
        $this->addSql('DROP INDEX IDX_FCF22AF459027487 ON liste');
        $this->addSql('ALTER TABLE liste DROP test_id, DROP entreprise_id, DROP vocabulaire_id, DROP theme_id');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D071E5D0459');
        $this->addSql('DROP INDEX IDX_7BAB8D071E5D0459 ON realiser');
        $this->addSql('ALTER TABLE realiser DROP test_id, CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD realiser_id INT DEFAULT NULL, ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CAC274FA8 FOREIGN KEY (realiser_id) REFERENCES realiser (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CAC274FA8 ON test (realiser_id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CE85441D8 ON test (liste_id)');
        $this->addSql('ALTER TABLE theme ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_9775E708E85441D8 ON theme (liste_id)');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE vocabulaire ADD liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vocabulaire ADD CONSTRAINT FK_DB1ADE7DE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('CREATE INDEX IDX_DB1ADE7DE85441D8 ON vocabulaire (liste_id)');
    }
}
