<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231110142930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, imdb_id, poster, plot, director FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, imdb_id VARCHAR(10) DEFAULT \'\' NOT NULL, poster VARCHAR(255) DEFAULT NULL, plot CLOB DEFAULT NULL, director VARCHAR(255) NOT NULL, year DATETIME DEFAULT \'1970\' NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO movie (id, title, imdb_id, poster, plot, director) SELECT id, title, imdb_id, poster, plot, director FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F53B538EB ON movie (imdb_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__movie AS SELECT id, title, imdb_id, poster, plot, director FROM movie');
        $this->addSql('DROP TABLE movie');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, imdb_id VARCHAR(10) DEFAULT \'\' NOT NULL, poster VARCHAR(255) DEFAULT NULL, plot CLOB DEFAULT NULL, director VARCHAR(255) DEFAULT \'\' NOT NULL)');
        $this->addSql('INSERT INTO movie (id, title, imdb_id, poster, plot, director) SELECT id, title, imdb_id, poster, plot, director FROM __temp__movie');
        $this->addSql('DROP TABLE __temp__movie');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D5EF26F53B538EB ON movie (imdb_id)');
    }
}
