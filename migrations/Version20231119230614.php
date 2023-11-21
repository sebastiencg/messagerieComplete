<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119230614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "group_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE group_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE response_message_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "group" (id INT NOT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, private_group BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6DC044C5F675F31B ON "group" (author_id)');
        $this->addSql('CREATE TABLE group_profile_admin (group_id INT NOT NULL, profile_id INT NOT NULL, PRIMARY KEY(group_id, profile_id))');
        $this->addSql('CREATE INDEX IDX_20335CE6FE54D947 ON group_profile_admin (group_id)');
        $this->addSql('CREATE INDEX IDX_20335CE6CCFA12B8 ON group_profile_admin (profile_id)');
        $this->addSql('CREATE TABLE group_profile_member (group_id INT NOT NULL, profile_id INT NOT NULL, PRIMARY KEY(group_id, profile_id))');
        $this->addSql('CREATE INDEX IDX_8043546DFE54D947 ON group_profile_member (group_id)');
        $this->addSql('CREATE INDEX IDX_8043546DCCFA12B8 ON group_profile_member (profile_id)');
        $this->addSql('CREATE TABLE group_message (id INT NOT NULL, author_id INT DEFAULT NULL, of_group_id INT DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_30BD6473F675F31B ON group_message (author_id)');
        $this->addSql('CREATE INDEX IDX_30BD647342CF2FAC ON group_message (of_group_id)');
        $this->addSql('COMMENT ON COLUMN group_message.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE response_message_group (id INT NOT NULL, author_id INT DEFAULT NULL, of_group_message_id INT DEFAULT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D31F6609F675F31B ON response_message_group (author_id)');
        $this->addSql('CREATE INDEX IDX_D31F6609FF3547DA ON response_message_group (of_group_message_id)');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT FK_6DC044C5F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_profile_admin ADD CONSTRAINT FK_20335CE6FE54D947 FOREIGN KEY (group_id) REFERENCES "group" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_profile_admin ADD CONSTRAINT FK_20335CE6CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_profile_member ADD CONSTRAINT FK_8043546DFE54D947 FOREIGN KEY (group_id) REFERENCES "group" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_profile_member ADD CONSTRAINT FK_8043546DCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message ADD CONSTRAINT FK_30BD6473F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_message ADD CONSTRAINT FK_30BD647342CF2FAC FOREIGN KEY (of_group_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response_message_group ADD CONSTRAINT FK_D31F6609F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE response_message_group ADD CONSTRAINT FK_D31F6609FF3547DA FOREIGN KEY (of_group_message_id) REFERENCES group_message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "group_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE group_message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE response_message_group_id_seq CASCADE');
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT FK_6DC044C5F675F31B');
        $this->addSql('ALTER TABLE group_profile_admin DROP CONSTRAINT FK_20335CE6FE54D947');
        $this->addSql('ALTER TABLE group_profile_admin DROP CONSTRAINT FK_20335CE6CCFA12B8');
        $this->addSql('ALTER TABLE group_profile_member DROP CONSTRAINT FK_8043546DFE54D947');
        $this->addSql('ALTER TABLE group_profile_member DROP CONSTRAINT FK_8043546DCCFA12B8');
        $this->addSql('ALTER TABLE group_message DROP CONSTRAINT FK_30BD6473F675F31B');
        $this->addSql('ALTER TABLE group_message DROP CONSTRAINT FK_30BD647342CF2FAC');
        $this->addSql('ALTER TABLE response_message_group DROP CONSTRAINT FK_D31F6609F675F31B');
        $this->addSql('ALTER TABLE response_message_group DROP CONSTRAINT FK_D31F6609FF3547DA');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE group_profile_admin');
        $this->addSql('DROP TABLE group_profile_member');
        $this->addSql('DROP TABLE group_message');
        $this->addSql('DROP TABLE response_message_group');
    }
}
