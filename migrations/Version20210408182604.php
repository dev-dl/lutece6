<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408182604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "developer" ADD first_name VARCHAR(255) ');
        $this->addSql('ALTER TABLE "developer" ADD last_name VARCHAR(255) ');
        $this->addSql('ALTER TABLE "developer" ADD password VARCHAR(255) ');
        $this->addSql('ALTER TABLE "developer" ADD profile_picture_file_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE developer ALTER COLUMN first_name SET NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER COLUMN last_name SET NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER COLUMN password SET NOT NULL');
        
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "developer" DROP first_name');
        $this->addSql('ALTER TABLE "developer" DROP last_name');
        $this->addSql('ALTER TABLE "developer" DROP password');
        $this->addSql('ALTER TABLE "user" DROP profile_picture_file_name');
    }
}
