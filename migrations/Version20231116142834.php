<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116142834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE private_message ADD ralation_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE private_message ADD CONSTRAINT FK_4744FC9B2C43215F FOREIGN KEY (ralation_id_id) REFERENCES relation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4744FC9B2C43215F ON private_message (ralation_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE private_message DROP CONSTRAINT FK_4744FC9B2C43215F');
        $this->addSql('DROP INDEX IDX_4744FC9B2C43215F');
        $this->addSql('ALTER TABLE private_message DROP ralation_id_id');
    }
}
