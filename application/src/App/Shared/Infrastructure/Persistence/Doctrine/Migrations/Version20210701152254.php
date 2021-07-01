<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210701152254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quizz (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', creator_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid_binary)\', date DATETIME NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, players INT NOT NULL, slug VARCHAR(255) NOT NULL, isPrivate TINYINT(1) NOT NULL, INDEX IDX_7C77973D61220EA6 (creator_id), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973D61220EA6 FOREIGN KEY (creator_id) REFERENCES users (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quizz');
    }
}
