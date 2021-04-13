<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412180849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE developer_auths ADD developer_id_id INT');
        $this->addSql('ALTER TABLE developer_auths ADD CONSTRAINT FK_E6C938BC90CC5E00 FOREIGN KEY (developer_id_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6C938BC90CC5E00 ON developer_auths (developer_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE developer_auths DROP CONSTRAINT FK_E6C938BC90CC5E00');
        $this->addSql('DROP INDEX UNIQ_E6C938BC90CC5E00');
        $this->addSql('ALTER TABLE developer_auths DROP developer_id_id');
    }
}
