<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113115618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation DROP CONSTRAINT fk_8a8e26e995a5c621');
        $this->addSql('DROP INDEX idx_8a8e26e995a5c621');
        $this->addSql('ALTER TABLE conversation RENAME COLUMN aurhor_id TO author_id');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E9F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8A8E26E9F675F31B ON conversation (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE conversation DROP CONSTRAINT FK_8A8E26E9F675F31B');
        $this->addSql('DROP INDEX IDX_8A8E26E9F675F31B');
        $this->addSql('ALTER TABLE conversation RENAME COLUMN author_id TO aurhor_id');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT fk_8a8e26e995a5c621 FOREIGN KEY (aurhor_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8a8e26e995a5c621 ON conversation (aurhor_id)');
    }
}
