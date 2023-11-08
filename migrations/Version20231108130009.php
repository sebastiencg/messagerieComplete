<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108130009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE relation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE request_relation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE relation (id INT NOT NULL, profile1_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62894749131AEC3F ON relation (profile1_id)');
        $this->addSql('CREATE TABLE request_relation (id INT NOT NULL, host_id INT DEFAULT NULL, guests_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97ACA76C1FB8D185 ON request_relation (host_id)');
        $this->addSql('CREATE INDEX IDX_97ACA76C825B2E45 ON request_relation (guests_id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749131AEC3F FOREIGN KEY (profile1_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE request_relation ADD CONSTRAINT FK_97ACA76C1FB8D185 FOREIGN KEY (host_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE request_relation ADD CONSTRAINT FK_97ACA76C825B2E45 FOREIGN KEY (guests_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE relation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE request_relation_id_seq CASCADE');
        $this->addSql('ALTER TABLE relation DROP CONSTRAINT FK_62894749131AEC3F');
        $this->addSql('ALTER TABLE request_relation DROP CONSTRAINT FK_97ACA76C1FB8D185');
        $this->addSql('ALTER TABLE request_relation DROP CONSTRAINT FK_97ACA76C825B2E45');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE request_relation');
    }
}
