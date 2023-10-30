<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025221454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA logs');
        $this->addSql('CREATE TABLE logs.logs (id UUID NOT NULL, message TEXT NOT NULL, context TEXT NOT NULL, level SMALLINT NOT NULL, level_name VARCHAR(255) NOT NULL, extra TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, formatted TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN logs.logs.context IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN logs.logs.extra IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE users.users ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN users.users.id IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE logs.logs');
        $this->addSql('ALTER TABLE users.users ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN users.users.id IS \'(DC2Type:uuid)\'');
    }
}
