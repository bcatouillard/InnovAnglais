<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210131301 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur ADD realiser_id INT DEFAULT NULL, CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AC274FA8 FOREIGN KEY (realiser_id) REFERENCES realiser (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3AC274FA8 ON utilisateur (realiser_id)');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD realiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CAC274FA8 FOREIGN KEY (realiser_id) REFERENCES realiser (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CAC274FA8 ON test (realiser_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CAC274FA8');
        $this->addSql('DROP INDEX IDX_D87F7E0CAC274FA8 ON test');
        $this->addSql('ALTER TABLE test DROP realiser_id');
        $this->addSql('ALTER TABLE type_abonnement CHANGE inscription_id inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AC274FA8');
        $this->addSql('DROP INDEX IDX_1D1C63B3AC274FA8 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP realiser_id, CHANGE inscription_id inscription_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
