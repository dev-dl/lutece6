<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409154222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP INDEX uniq_65fb8b9a989d9b62');
        $this->addSql('ALTER TABLE developer DROP COLUMN profile_picture_file_name');
        $this->addSql('ALTER TABLE developer ALTER email SET NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER last_name SET NOT NULL');
        $this->addSql('ALTER TABLE developer DROP COLUMN password');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, profile_picture_file_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE developer ADD profile_picture_file_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE developer ALTER email DROP NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER password DROP NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER last_name DROP NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER first_name DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_65fb8b9a989d9b62 ON developer (slug)');
    }
}
