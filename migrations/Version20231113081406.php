<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113081406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE conversation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE conversation (id INT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE conversation_profile (conversation_id INT NOT NULL, profile_id INT NOT NULL, PRIMARY KEY(conversation_id, profile_id))');
        $this->addSql('CREATE INDEX IDX_1A01A4059AC0396 ON conversation_profile (conversation_id)');
        $this->addSql('CREATE INDEX IDX_1A01A405CCFA12B8 ON conversation_profile (profile_id)');
        $this->addSql('ALTER TABLE conversation_profile ADD CONSTRAINT FK_1A01A4059AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE conversation_profile ADD CONSTRAINT FK_1A01A405CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE conversation_id_seq CASCADE');
        $this->addSql('ALTER TABLE conversation_profile DROP CONSTRAINT FK_1A01A4059AC0396');
        $this->addSql('ALTER TABLE conversation_profile DROP CONSTRAINT FK_1A01A405CCFA12B8');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE conversation_profile');
    }
}
