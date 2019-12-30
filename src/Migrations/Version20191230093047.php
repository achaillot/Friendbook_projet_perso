<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191230093047 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, response LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advice (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, response LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, activity_id INT DEFAULT NULL, advice_id INT DEFAULT NULL, message LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E81C06096 (activity_id), INDEX IDX_B6F7494E12998205 (advice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E12998205 FOREIGN KEY (advice_id) REFERENCES advice (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E81C06096');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E12998205');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE advice');
        $this->addSql('DROP TABLE question');
    }
}
