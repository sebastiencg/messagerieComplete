<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108131114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation ADD profile2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_628947491AF43D1 FOREIGN KEY (profile2_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_628947491AF43D1 ON relation (profile2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE relation DROP CONSTRAINT FK_628947491AF43D1');
        $this->addSql('DROP INDEX IDX_628947491AF43D1');
        $this->addSql('ALTER TABLE relation DROP profile2_id');
    }
}
