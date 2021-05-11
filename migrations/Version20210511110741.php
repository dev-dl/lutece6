<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511110741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_auths ADD developer_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_auths DROP user_id');
        $this->addSql('ALTER TABLE user_auths ADD CONSTRAINT FK_EB8303B364DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB8303B364DD9267 ON user_auths (developer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_auths DROP CONSTRAINT FK_EB8303B364DD9267');
        $this->addSql('DROP INDEX UNIQ_EB8303B364DD9267');
        $this->addSql('ALTER TABLE user_auths ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_auths DROP developer_id');
    }
}
