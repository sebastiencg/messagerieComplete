<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114081042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation_message ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conversation_message ADD CONSTRAINT FK_2DEB3E75F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2DEB3E75F675F31B ON conversation_message (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE conversation_message DROP CONSTRAINT FK_2DEB3E75F675F31B');
        $this->addSql('DROP INDEX IDX_2DEB3E75F675F31B');
        $this->addSql('ALTER TABLE conversation_message DROP author_id');
    }
}