<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231111130938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE book_movie (book_id INTEGER NOT NULL, movie_id INTEGER NOT NULL, PRIMARY KEY(book_id, movie_id), CONSTRAINT FK_139CE71616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_139CE7168F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_139CE71616A2B381 ON book_movie (book_id)');
        $this->addSql('CREATE INDEX IDX_139CE7168F93B6FC ON book_movie (movie_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, imdb_id, poster, plot, director, year FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, imdb_id VARCHAR(10) DEFAULT \'\' NOT NULL, poster VARCHAR(255) DEFAULT NULL, plot CLOB DEFAULT NULL, director VARCHAR(255) NOT NULL, year DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO movie (id, title, imdb_id, poster, plot, director, year) SELECT id, title, imdb_id, poster, plot, director, year FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F53B538EB ON movie (imdb_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_movie');
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, imdb_id, poster, plot, director, year FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, imdb_id VARCHAR(10) DEFAULT \'\' NOT NULL, poster VARCHAR(255) DEFAULT NULL, plot CLOB DEFAULT NULL, director VARCHAR(255) NOT NULL, year DATETIME DEFAULT \'1970\' NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO movie (id, title, imdb_id, poster, plot, director, year) SELECT id, title, imdb_id, poster, plot, director, year FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F53B538EB ON movie (imdb_id)');
    }
}
