<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108205315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request_relation ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE request_relation ADD CONSTRAINT FK_97ACA76C3256915B FOREIGN KEY (relation_id) REFERENCES relation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97ACA76C3256915B ON request_relation (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE request_relation DROP CONSTRAINT FK_97ACA76C3256915B');
        $this->addSql('DROP INDEX UNIQ_97ACA76C3256915B');
        $this->addSql('ALTER TABLE request_relation DROP relation_id');
    }
}
