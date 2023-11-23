<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121225448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_f11d61a242cf2fac');
        $this->addSql('DROP INDEX uniq_f11d61a2ccfa12b8');
        $this->addSql('CREATE INDEX IDX_F11D61A2CCFA12B8 ON invitation (profile_id)');
        $this->addSql('CREATE INDEX IDX_F11D61A242CF2FAC ON invitation (of_group_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_F11D61A2CCFA12B8');
        $this->addSql('DROP INDEX IDX_F11D61A242CF2FAC');
        $this->addSql('CREATE UNIQUE INDEX uniq_f11d61a242cf2fac ON invitation (of_group_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_f11d61a2ccfa12b8 ON invitation (profile_id)');
    }
}
