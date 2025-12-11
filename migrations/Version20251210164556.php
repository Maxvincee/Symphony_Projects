<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251210164556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collect (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(20) NOT NULL, date_modif_statut DATETIME NOT NULL, prix_achat NUMERIC(6, 2) DEFAULT NULL, date_achat DATE DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, utilisateur_id INT NOT NULL, jeuvideo_id INT NOT NULL, INDEX IDX_A40662F4FB88E14F (utilisateur_id), INDEX IDX_A40662F418E5E9D9 (jeuvideo_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, pseudo VARCHAR(30) NOT NULL, mail VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, image_profil VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B386CC499D (pseudo), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE collect ADD CONSTRAINT FK_A40662F4FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE collect ADD CONSTRAINT FK_A40662F418E5E9D9 FOREIGN KEY (jeuvideo_id) REFERENCES jeu_video (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collect DROP FOREIGN KEY FK_A40662F4FB88E14F');
        $this->addSql('ALTER TABLE collect DROP FOREIGN KEY FK_A40662F418E5E9D9');
        $this->addSql('DROP TABLE collect');
        $this->addSql('DROP TABLE utilisateur');
    }
}
