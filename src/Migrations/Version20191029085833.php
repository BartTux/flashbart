<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191029085833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_flashcards (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_flashcards_users (user_flashcards_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_4B199D0AB05C1519 (user_flashcards_id), INDEX IDX_4B199D0A67B3B43D (users_id), PRIMARY KEY(user_flashcards_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_flashcards_flashcards (user_flashcards_id INT NOT NULL, flashcards_id INT NOT NULL, INDEX IDX_F5EE3749B05C1519 (user_flashcards_id), INDEX IDX_F5EE37495ED2B849 (flashcards_id), PRIMARY KEY(user_flashcards_id, flashcards_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_flashcards_users ADD CONSTRAINT FK_4B199D0AB05C1519 FOREIGN KEY (user_flashcards_id) REFERENCES user_flashcards (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_flashcards_users ADD CONSTRAINT FK_4B199D0A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_flashcards_flashcards ADD CONSTRAINT FK_F5EE3749B05C1519 FOREIGN KEY (user_flashcards_id) REFERENCES user_flashcards (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_flashcards_flashcards ADD CONSTRAINT FK_F5EE37495ED2B849 FOREIGN KEY (flashcards_id) REFERENCES flashcards (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE flashcards CHANGE creation_date creation_date DATETIME NOT NULL, CHANGE modified_date modified_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_flashcards_users DROP FOREIGN KEY FK_4B199D0AB05C1519');
        $this->addSql('ALTER TABLE user_flashcards_flashcards DROP FOREIGN KEY FK_F5EE3749B05C1519');
        $this->addSql('DROP TABLE user_flashcards');
        $this->addSql('DROP TABLE user_flashcards_users');
        $this->addSql('DROP TABLE user_flashcards_flashcards');
        $this->addSql('ALTER TABLE flashcards CHANGE creation_date creation_date DATETIME NOT NULL, CHANGE modified_date modified_date DATETIME NOT NULL');
    }
}
