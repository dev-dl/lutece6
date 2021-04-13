<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413160046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE developer ALTER slug SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_65FB8B9A989D9B62 ON developer (slug)');
        $this->addSql('ALTER TABLE developer_auths DROP CONSTRAINT fk_e6c938bc90cc5e00');
        $this->addSql('DROP INDEX uniq_e6c938bc90cc5e00');
        $this->addSql('ALTER TABLE developer_auths DROP developer_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE developer_auths ADD developer_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE developer_auths ADD CONSTRAINT fk_e6c938bc90cc5e00 FOREIGN KEY (developer_id_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_e6c938bc90cc5e00 ON developer_auths (developer_id_id)');
        $this->addSql('DROP INDEX UNIQ_65FB8B9A989D9B62');
        $this->addSql('ALTER TABLE developer ALTER slug DROP NOT NULL');
    }
}
