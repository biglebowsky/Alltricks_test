<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623205806 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Insertion of data in Database tables Source and Article';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO source_type VALUES (1, 'database');");
        $this->addSql("INSERT INTO source_type VALUES (2, 'rss');");
        $this->addSql("INSERT INTO source VALUES (1, 'src-1', 1);");
        $this->addSql("INSERT INTO source VALUES (2, 'Le Monde.fr - Actualités et Infos en France et dans le monde', 2);");
        $this->addSql("INSERT INTO source VALUES (3, 'src-2',1);");
        $this->addSql("INSERT INTO article VALUES (1, 1, 'Article 1', 'Lorem ipsum dolor sit amet 1');");
        $this->addSql("INSERT INTO article VALUES (2, 3, 'Article 2', 'Lorem ipsum dolor sit amet 2');");
        $this->addSql("INSERT INTO article VALUES (3, 3, 'Article 3', 'Lorem ipsum dolor sit amet 3');");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM article WHERE 1=1;");
        $this->addSql("DELETE FROM source WHERE 1=1;");
        $this->addSql("DELETE FROM source_type WHERE 1=1;");
    }
}
