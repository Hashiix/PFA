<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210627180845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE complete (id INT AUTO_INCREMENT NOT NULL, anime INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE complete_member (complete_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_7FB3193EEA40C2F (complete_id), INDEX IDX_7FB3193E7597D3FE (member_id), PRIMARY KEY(complete_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, anime INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_member (planning_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_10C5D8173D865311 (planning_id), INDEX IDX_10C5D8177597D3FE (member_id), PRIMARY KEY(planning_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watching (id INT AUTO_INCREMENT NOT NULL, anime INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watching_member (watching_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_E30C7932FFC1EAF7 (watching_id), INDEX IDX_E30C79327597D3FE (member_id), PRIMARY KEY(watching_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE complete_member ADD CONSTRAINT FK_7FB3193EEA40C2F FOREIGN KEY (complete_id) REFERENCES complete (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complete_member ADD CONSTRAINT FK_7FB3193E7597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_member ADD CONSTRAINT FK_10C5D8173D865311 FOREIGN KEY (planning_id) REFERENCES planning (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_member ADD CONSTRAINT FK_10C5D8177597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE watching_member ADD CONSTRAINT FK_E30C7932FFC1EAF7 FOREIGN KEY (watching_id) REFERENCES watching (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE watching_member ADD CONSTRAINT FK_E30C79327597D3FE FOREIGN KEY (member_id) REFERENCES member (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE complete_member DROP FOREIGN KEY FK_7FB3193EEA40C2F');
        $this->addSql('ALTER TABLE planning_member DROP FOREIGN KEY FK_10C5D8173D865311');
        $this->addSql('ALTER TABLE watching_member DROP FOREIGN KEY FK_E30C7932FFC1EAF7');
        $this->addSql('DROP TABLE complete');
        $this->addSql('DROP TABLE complete_member');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE planning_member');
        $this->addSql('DROP TABLE watching');
        $this->addSql('DROP TABLE watching_member');
    }
}
