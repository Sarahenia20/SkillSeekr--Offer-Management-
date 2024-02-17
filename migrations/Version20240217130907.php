<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217130907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D11962E2B4');
        $this->addSql('DROP INDEX IDX_C6461D11962E2B4 ON offer_skills');
        $this->addSql('DROP INDEX `primary` ON offer_skills');
        $this->addSql('ALTER TABLE offer_skills CHANGE skill_name skills VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D1D5311670 FOREIGN KEY (skills) REFERENCES skill (skill)');
        $this->addSql('CREATE INDEX IDX_C6461D1D5311670 ON offer_skills (skills)');
        $this->addSql('ALTER TABLE offer_skills ADD PRIMARY KEY (offer_id, skills)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D1D5311670');
        $this->addSql('DROP INDEX IDX_C6461D1D5311670 ON offer_skills');
        $this->addSql('DROP INDEX `PRIMARY` ON offer_skills');
        $this->addSql('ALTER TABLE offer_skills CHANGE skills skill_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D11962E2B4 FOREIGN KEY (skill_name) REFERENCES skill (skill)');
        $this->addSql('CREATE INDEX IDX_C6461D11962E2B4 ON offer_skills (skill_name)');
        $this->addSql('ALTER TABLE offer_skills ADD PRIMARY KEY (offer_id, skill_name)');
    }
}
