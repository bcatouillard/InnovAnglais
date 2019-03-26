<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210144511 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste CHANGE test_id test_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE vocabulaire_id vocabulaire_id INT DEFAULT NULL, CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realiser CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE vocabulaires_id vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste CHANGE test_id test_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE vocabulaire_id vocabulaire_id INT DEFAULT NULL, CHANGE theme_id theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE realiser CHANGE utilisateur_id utilisateur_id INT DEFAULT NULL, CHANGE test_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
