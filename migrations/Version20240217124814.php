<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217124814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer_skills (offer_id INT NOT NULL, skill_name VARCHAR(255) NOT NULL, INDEX IDX_C6461D153C674EE (offer_id), INDEX IDX_C6461D11962E2B4 (skill_name), PRIMARY KEY(offer_id, skill_name)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (skill VARCHAR(255) NOT NULL, PRIMARY KEY(skill)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D11962E2B4 FOREIGN KEY (skill_name) REFERENCES skill (skill)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D153C674EE');
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D11962E2B4');
        $this->addSql('DROP TABLE offer_skills');
        $this->addSql('DROP TABLE skill');
    }
}
