<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204115810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favori (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_ajout DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE favori_utilisateur (favori_id INTEGER NOT NULL, utilisateur_id INTEGER NOT NULL, PRIMARY KEY (favori_id, utilisateur_id), CONSTRAINT FK_5ABDCB2AFF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5ABDCB2AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5ABDCB2AFF17033F ON favori_utilisateur (favori_id)');
        $this->addSql('CREATE INDEX IDX_5ABDCB2AFB88E14F ON favori_utilisateur (utilisateur_id)');
        $this->addSql('CREATE TABLE favori_film (favori_id INTEGER NOT NULL, film_id INTEGER NOT NULL, PRIMARY KEY (favori_id, film_id), CONSTRAINT FK_2AFE2C25FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2AFE2C25567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2AFE2C25FF17033F ON favori_film (favori_id)');
        $this->addSql('CREATE INDEX IDX_2AFE2C25567F5183 ON favori_film (film_id)');
        $this->addSql('CREATE TABLE film (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, annee INTEGER NOT NULL, duree INTEGER NOT NULL, synopsis CLOB NOT NULL, genre VARCHAR(15) NOT NULL, prix_location_par_defaut DOUBLE PRECISION NOT NULL, image_url VARCHAR(255) NOT NULL, location_id INTEGER DEFAULT NULL, CONSTRAINT FK_8244BE2264D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8244BE2264D218E ON film (location_id)');
        $this->addSql('CREATE TABLE location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_location DATETIME NOT NULL, date_retour_prevue DATE NOT NULL, prix_final DOUBLE PRECISION NOT NULL, statut VARCHAR(15) NOT NULL)');
        $this->addSql('CREATE TABLE location_utilisateur (location_id INTEGER NOT NULL, utilisateur_id INTEGER NOT NULL, PRIMARY KEY (location_id, utilisateur_id), CONSTRAINT FK_BC984F764D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BC984F7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BC984F764D218E ON location_utilisateur (location_id)');
        $this->addSql('CREATE INDEX IDX_BC984F7FB88E14F ON location_utilisateur (utilisateur_id)');
        $this->addSql('CREATE TABLE tarif_dynamique (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, jour_semaine INTEGER NOT NULL, pourcentage_reduction DOUBLE PRECISION NOT NULL, actif BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(100) NOT NULL, mdp_hash VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, date_inscription DATETIME NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE favori_utilisateur');
        $this->addSql('DROP TABLE favori_film');
        $this->addSql('DROP TABLE film');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_utilisateur');
        $this->addSql('DROP TABLE tarif_dynamique');
        $this->addSql('DROP TABLE utilisateur');
    }
}
