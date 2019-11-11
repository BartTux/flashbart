<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191109085802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trash (id INT AUTO_INCREMENT NOT NULL, flashcard_id INT NOT NULL, UNIQUE INDEX UNIQ_528BB4DC5D16576 (flashcard_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trash ADD CONSTRAINT FK_528BB4DC5D16576 FOREIGN KEY (flashcard_id) REFERENCES flashcards (id)');
        $this->addSql('ALTER TABLE flashcards CHANGE creation_date creation_date DATETIME NOT NULL, CHANGE modified_date modified_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE trash');
        $this->addSql('ALTER TABLE flashcards CHANGE creation_date creation_date DATETIME NOT NULL, CHANGE modified_date modified_date DATETIME NOT NULL');
    }
}
