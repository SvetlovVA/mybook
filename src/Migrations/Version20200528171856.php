<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528171856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        //$this->addSql('ALTER INDEX idx_comment_conference_id RENAME TO IDX_9474526C604B8382');
        //$this->addSql('ALTER TABLE conference ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE conference ADD slug VARCHAR(255)');
        $this->addSql("UPDATE conference SET slug=CONCAT(LOWER(city), '-',year)");
        $this->addSql('ALTER TABLE conference ALTER COLUMN slug SET NOT NULL');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE conference DROP slug');
        $this->addSql('ALTER INDEX idx_9474526c604b8382 RENAME TO idx_comment_conference_id');
    }
}
