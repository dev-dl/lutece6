<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326141637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_set DROP CONSTRAINT fk_1547e832166d1f9c');
        $this->addSql('DROP INDEX idx_1547e832166d1f9c');
        $this->addSql('ALTER TABLE skill_set DROP project_id');
        $this->addSql('ALTER TABLE skill_set DROP COLUMN project_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE skill_set ADD project_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill_set ADD CONSTRAINT fk_1547e832166d1f9c FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1547e832166d1f9c ON skill_set (project_id)');
    }
}
