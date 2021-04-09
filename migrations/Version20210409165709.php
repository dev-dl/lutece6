<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409165709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE developer ALTER email DROP NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE developer_auths ADD username VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE developer_auths ADD is_verified BOOLEAN NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C938BCE7927C74 ON developer_auths (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C938BCF85E0677 ON developer_auths (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_E6C938BCE7927C74');
        $this->addSql('DROP INDEX UNIQ_E6C938BCF85E0677');
        $this->addSql('ALTER TABLE developer_auths DROP username');
        $this->addSql('ALTER TABLE developer_auths DROP is_verified');
        $this->addSql('ALTER TABLE developer ALTER email SET NOT NULL');
        $this->addSql('ALTER TABLE developer ALTER first_name SET NOT NULL');
    }
}
