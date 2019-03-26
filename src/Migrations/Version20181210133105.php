<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210133105 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD vocabulaires_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6347EA05DB0 FOREIGN KEY (vocabulaires_id) REFERENCES vocabulaire (id)');
        $this->addSql('CREATE INDEX IDX_497DD6347EA05DB0 ON categorie (vocabulaires_id)');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6347EA05DB0');
        $this->addSql('DROP INDEX IDX_497DD6347EA05DB0 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP vocabulaires_id');
        $this->addSql('ALTER TABLE test CHANGE realiser_id realiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE realiser_id realiser_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
