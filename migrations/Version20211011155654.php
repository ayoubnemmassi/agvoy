<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011155654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_F62F1764C58917C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__region AS SELECT id, roomsinregions_id, name, presentation, country FROM region');
        $this->addSql('DROP TABLE region');
        $this->addSql('CREATE TABLE region (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, roomsinregions_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, presentation CLOB DEFAULT NULL COLLATE BINARY, country VARCHAR(2) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_F62F1764C58917C FOREIGN KEY (roomsinregions_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO region (id, roomsinregions_id, name, presentation, country) SELECT id, roomsinregions_id, name, presentation, country FROM __temp__region');
        $this->addSql('DROP TABLE __temp__region');
        $this->addSql('CREATE INDEX IDX_F62F1764C58917C ON region (roomsinregions_id)');
        $this->addSql('DROP INDEX IDX_729F519B7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, owner_id, summary, description, capacity, superficy, price, address, image_name, image_updated_at, content_type FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, summary CLOB DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, capacity INTEGER NOT NULL, superficy DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, address CLOB NOT NULL COLLATE BINARY, image_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, image_updated_at DATETIME DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_729F519B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO room (id, owner_id, summary, description, capacity, superficy, price, address, image_name, image_updated_at, content_type) SELECT id, owner_id, summary, description, capacity, superficy, price, address, image_name, image_updated_at, content_type FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_F62F1764C58917C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__region AS SELECT id, roomsinregions_id, name, presentation, country FROM region');
        $this->addSql('DROP TABLE region');
        $this->addSql('CREATE TABLE region (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, roomsinregions_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, presentation CLOB DEFAULT NULL, country VARCHAR(2) DEFAULT NULL)');
        $this->addSql('INSERT INTO region (id, roomsinregions_id, name, presentation, country) SELECT id, roomsinregions_id, name, presentation, country FROM __temp__region');
        $this->addSql('DROP TABLE __temp__region');
        $this->addSql('CREATE INDEX IDX_F62F1764C58917C ON region (roomsinregions_id)');
        $this->addSql('DROP INDEX IDX_729F519B7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, owner_id, image_name, image_updated_at, summary, content_type, description, capacity, superficy, price, address FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_updated_at DATETIME DEFAULT NULL, summary CLOB DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, capacity INTEGER NOT NULL, superficy DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, address CLOB NOT NULL)');
        $this->addSql('INSERT INTO room (id, owner_id, image_name, image_updated_at, summary, content_type, description, capacity, superficy, price, address) SELECT id, owner_id, image_name, image_updated_at, summary, content_type, description, capacity, superficy, price, address FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
    }
}
