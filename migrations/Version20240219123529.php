<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219123529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D1D5311670');
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D153C674EE');
        $this->addSql('DROP TABLE offer_skills');
        $this->addSql('ALTER TABLE offer MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON offer');
        $this->addSql('ALTER TABLE offer CHANGE id offerId INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD PRIMARY KEY (offerId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer_skills (offer_id INT NOT NULL, skills VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C6461D153C674EE (offer_id), INDEX IDX_C6461D1D5311670 (skills), PRIMARY KEY(offer_id, skills)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D1D5311670 FOREIGN KEY (skills) REFERENCES skill (skill)');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer MODIFY offerId INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON offer');
        $this->addSql('ALTER TABLE offer CHANGE offerId id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD PRIMARY KEY (id)');
    }
}
