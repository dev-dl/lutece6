<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508174901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE candidate_id_seq CASCADE');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('ALTER TABLE position ADD action VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE position ALTER title DROP NOT NULL');
        $this->addSql('ALTER TABLE position ALTER slug SET NOT NULL');
    }
}
