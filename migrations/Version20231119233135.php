<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231119233135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE invitation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE invitation (id INT NOT NULL, profile_id INT DEFAULT NULL, of_group_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F11D61A2CCFA12B8 ON invitation (profile_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F11D61A242CF2FAC ON invitation (of_group_id)');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A242CF2FAC FOREIGN KEY (of_group_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE invitation_id_seq CASCADE');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A2CCFA12B8');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A242CF2FAC');
        $this->addSql('DROP TABLE invitation');
    }
}
