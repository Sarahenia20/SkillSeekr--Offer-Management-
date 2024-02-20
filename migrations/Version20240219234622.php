<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219234622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (location VARCHAR(50) NOT NULL, PRIMARY KEY(location)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motive (motive VARCHAR(50) NOT NULL, PRIMARY KEY(motive)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, motive VARCHAR(50) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, location VARCHAR(50) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, author VARCHAR(255) NOT NULL, created_at DATE NOT NULL, INDEX IDX_29D6873EF92CD178 (motive), INDEX IDX_29D6873E8CDE5729 (type), INDEX IDX_29D6873E5E9E89CB (location), INDEX IDX_29D6873E7B00651C (status), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_skills (id INT NOT NULL, skill VARCHAR(255) NOT NULL, INDEX IDX_C6461D1BF396750 (id), INDEX IDX_C6461D15E3DE477 (skill), PRIMARY KEY(id, skill)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (skill VARCHAR(255) NOT NULL, PRIMARY KEY(skill)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (status VARCHAR(50) NOT NULL, PRIMARY KEY(status)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (type VARCHAR(50) NOT NULL, PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, role VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EF92CD178 FOREIGN KEY (motive) REFERENCES motive (motive)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E8CDE5729 FOREIGN KEY (type) REFERENCES type (type)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E5E9E89CB FOREIGN KEY (location) REFERENCES location (location)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E7B00651C FOREIGN KEY (status) REFERENCES status (status)');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D1BF396750 FOREIGN KEY (id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer_skills ADD CONSTRAINT FK_C6461D15E3DE477 FOREIGN KEY (skill) REFERENCES skill (skill)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EF92CD178');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E8CDE5729');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E5E9E89CB');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E7B00651C');
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D1BF396750');
        $this->addSql('ALTER TABLE offer_skills DROP FOREIGN KEY FK_C6461D15E3DE477');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE motive');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_skills');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
