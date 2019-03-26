<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210134422 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vocabulaire CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme DROP id_theme, CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE theme ADD id_theme INT NOT NULL, CHANGE liste_id liste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE vocabulaire CHANGE liste_id liste_id INT DEFAULT NULL');
    }
}
