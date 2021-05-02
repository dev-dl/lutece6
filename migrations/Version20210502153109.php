<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502153109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_set DROP CONSTRAINT fk_1547e83264dd9267');
        $this->addSql('DROP INDEX idx_1547e83264dd9267');
        $this->addSql('ALTER TABLE skill_set DROP developer_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE skill_set ADD developer_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill_set ADD CONSTRAINT fk_1547e83264dd9267 FOREIGN KEY (developer_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1547e83264dd9267 ON skill_set (developer_id)');
    }
}
