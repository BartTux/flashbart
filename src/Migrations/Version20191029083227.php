<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191029083227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE words (id INT AUTO_INCREMENT NOT NULL, parts_of_speech_id INT NOT NULL, languages_id INT NOT NULL, word VARCHAR(100) NOT NULL, INDEX IDX_717D1E8CC153B598 (parts_of_speech_id), INDEX IDX_717D1E8C5D237A9A (languages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flashcards (id INT AUTO_INCREMENT NOT NULL, words_id INT NOT NULL, translations_id INT NOT NULL, pronunciation VARCHAR(100) DEFAULT NULL, example_sentence VARCHAR(100) DEFAULT NULL, creation_date DATETIME NOT NULL, modified_date DATETIME NOT NULL, INDEX IDX_62A226B5749B15FB (words_id), INDEX IDX_62A226B5ACE9C349 (translations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parts_of_speech (id INT AUTO_INCREMENT NOT NULL, part_of_speech VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE languages (id INT AUTO_INCREMENT NOT NULL, language VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE words ADD CONSTRAINT FK_717D1E8CC153B598 FOREIGN KEY (parts_of_speech_id) REFERENCES parts_of_speech (id)');
        $this->addSql('ALTER TABLE words ADD CONSTRAINT FK_717D1E8C5D237A9A FOREIGN KEY (languages_id) REFERENCES languages (id)');
        $this->addSql('ALTER TABLE flashcards ADD CONSTRAINT FK_62A226B5749B15FB FOREIGN KEY (words_id) REFERENCES words (id)');
        $this->addSql('ALTER TABLE flashcards ADD CONSTRAINT FK_62A226B5ACE9C349 FOREIGN KEY (translations_id) REFERENCES words (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flashcards DROP FOREIGN KEY FK_62A226B5749B15FB');
        $this->addSql('ALTER TABLE flashcards DROP FOREIGN KEY FK_62A226B5ACE9C349');
        $this->addSql('ALTER TABLE words DROP FOREIGN KEY FK_717D1E8CC153B598');
        $this->addSql('ALTER TABLE words DROP FOREIGN KEY FK_717D1E8C5D237A9A');
        $this->addSql('DROP TABLE words');
        $this->addSql('DROP TABLE flashcards');
        $this->addSql('DROP TABLE parts_of_speech');
        $this->addSql('DROP TABLE languages');
    }
}
