<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323195304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE activity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE developer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE skill_set_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE activity (id INT NOT NULL, project_id INT NOT NULL, developer_id INT NOT NULL, skill VARCHAR(255) NOT NULL, time_used INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AC74095A166D1F9C ON activity (project_id)');
        $this->addSql('CREATE INDEX IDX_AC74095A64DD9267 ON activity (developer_id)');
        $this->addSql('CREATE TABLE developer (id INT NOT NULL, developer_name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, social_network VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, photo_file_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, project_name VARCHAR(255) NOT NULL, description TEXT NOT NULL, cover_image_file_name VARCHAR(255) DEFAULT NULL, is_private BOOLEAN NOT NULL, tags VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skill_set (id INT NOT NULL, developer_id INT NOT NULL, project_id INT NOT NULL, skill VARCHAR(255) NOT NULL, percentage INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1547E83264DD9267 ON skill_set (developer_id)');
        $this->addSql('CREATE INDEX IDX_1547E832166D1F9C ON skill_set (project_id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A64DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skill_set ADD CONSTRAINT FK_1547E83264DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skill_set ADD CONSTRAINT FK_1547E832166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE activity DROP CONSTRAINT FK_AC74095A64DD9267');
        $this->addSql('ALTER TABLE skill_set DROP CONSTRAINT FK_1547E83264DD9267');
        $this->addSql('ALTER TABLE activity DROP CONSTRAINT FK_AC74095A166D1F9C');
        $this->addSql('ALTER TABLE skill_set DROP CONSTRAINT FK_1547E832166D1F9C');
        $this->addSql('DROP SEQUENCE activity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE developer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE skill_set_id_seq CASCADE');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE skill_set');
    }
}
