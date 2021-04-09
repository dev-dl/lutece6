<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408183619 extends AbstractMigration
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
        $this->addSql('ALTER TABLE developer ADD first_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE developer ADD last_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE developer ADD password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE developer ADD profile_picture_file_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE developer DROP developer_name');
        $this->addSql('ALTER TABLE "user" ALTER description DROP NOT NULL');
    }
}
