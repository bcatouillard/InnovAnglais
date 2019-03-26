<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210144713 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(100) NOT NULL, telephone VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vocabulaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_abonnement (id INT AUTO_INCREMENT NOT NULL, inscription_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, INDEX IDX_2811BE9E5DAC5993 (inscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nb_payement INT NOT NULL, INDEX IDX_5E90F6D6FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, vocabulaires_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, INDEX IDX_497DD6347EA05DB0 (vocabulaires_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, vocabulaire_id INT DEFAULT NULL, theme_id INT DEFAULT NULL, INDEX IDX_FCF22AF41E5D0459 (test_id), INDEX IDX_FCF22AF4A4AEAFEA (entreprise_id), INDEX IDX_FCF22AF4D8B12F03 (vocabulaire_id), INDEX IDX_FCF22AF459027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realiser (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, test_id INT DEFAULT NULL, date DATE NOT NULL, resultat INT NOT NULL, commentaire VARCHAR(100) NOT NULL, INDEX IDX_7BAB8D07FB88E14F (utilisateur_id), INDEX IDX_7BAB8D071E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_abonnement ADD CONSTRAINT FK_2811BE9E5DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6347EA05DB0 FOREIGN KEY (vocabulaires_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF41E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4D8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF459027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D07FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D071E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FB88E14F');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D07FB88E14F');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6347EA05DB0');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4D8B12F03');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF459027487');
        $this->addSql('ALTER TABLE type_abonnement DROP FOREIGN KEY FK_2811BE9E5DAC5993');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4A4AEAFEA');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF41E5D0459');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D071E5D0459');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vocabulaire');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE type_abonnement');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE realiser');
        $this->addSql('DROP TABLE test');
    }
}
