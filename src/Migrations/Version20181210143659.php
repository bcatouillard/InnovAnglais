<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210143659 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B35DAC5993');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AC274FA8');
        $this->addSql('DROP INDEX IDX_1D1C63B35DAC5993 ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B3AC274FA8 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP inscription_id, DROP realiser_id, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vocabulaire CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6FB88E14F ON inscription (utilisateur_id)');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realiser ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D07FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_7BAB8D07FB88E14F ON realiser (utilisateur_id)');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FB88E14F');
        $this->addSql('DROP INDEX IDX_5E90F6D6FB88E14F ON inscription');
        $this->addSql('ALTER TABLE inscription DROP utilisateur_id');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D07FB88E14F');
        $this->addSql('DROP INDEX IDX_7BAB8D07FB88E14F ON realiser');
        $this->addSql('ALTER TABLE realiser DROP utilisateur_id');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD inscription_id INT DEFAULT NULL, ADD realiser_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B35DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AC274FA8 FOREIGN KEY (realiser_id) REFERENCES realiser (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B35DAC5993 ON utilisateur (inscription_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3AC274FA8 ON utilisateur (realiser_id)');
        $this->addSql('ALTER TABLE vocabulaire CHANGE liste_id liste_id INT DEFAULT NULL');
    }
}
