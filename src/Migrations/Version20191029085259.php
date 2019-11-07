<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191029085259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(50) NOT NULL, country_mark VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, countries_id INT NOT NULL, languages_id INT NOT NULL, firstname VARCHAR(50) DEFAULT NULL, surename VARCHAR(50) DEFAULT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(100) NOT NULL, gender LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_1483A5E9AEBAE514 (countries_id), INDEX IDX_1483A5E95D237A9A (languages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9AEBAE514 FOREIGN KEY (countries_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E95D237A9A FOREIGN KEY (languages_id) REFERENCES languages (id)');
        $this->addSql('ALTER TABLE flashcards CHANGE creation_date creation_date DATETIME NOT NULL, CHANGE modified_date modified_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9AEBAE514');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE flashcards CHANGE creation_date creation_date DATETIME NOT NULL, CHANGE modified_date modified_date DATETIME NOT NULL');
    }
}
