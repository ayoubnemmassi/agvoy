<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011171022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, address CLOB NOT NULL, country VARCHAR(2) DEFAULT NULL)');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_id INTEGER NOT NULL, client_id INTEGER NOT NULL, date DATETIME NOT NULL, periode DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, status BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
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
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, password, firstname, lastname, roles, is_verified FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, firstname VARCHAR(255) DEFAULT NULL COLLATE BINARY, lastname VARCHAR(255) DEFAULT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , is_verified BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, password, firstname, lastname, roles, is_verified) SELECT id, email, password, firstname, lastname, roles, is_verified FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE reservation');
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
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, firstname, lastname, is_verified FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, firstname, lastname, is_verified) SELECT id, email, roles, password, firstname, lastname, is_verified FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
