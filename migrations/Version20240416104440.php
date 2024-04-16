<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416104440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD le_chauffeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558899931 FOREIGN KEY (le_chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_42C849558899931 ON reservation (le_chauffeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558899931');
        $this->addSql('DROP INDEX IDX_42C849558899931 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP le_chauffeur_id');
    }
}
