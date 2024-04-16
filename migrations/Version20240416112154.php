<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416112154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558899931');
        $this->addSql('DROP INDEX IDX_42C849558899931 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP le_chauffeur_id, CHANGE id_chauffeur leChauffeur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849553ED89B92 FOREIGN KEY (leChauffeur) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_42C849553ED89B92 ON reservation (leChauffeur)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE controle');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553ED89B92');
        $this->addSql('DROP INDEX IDX_42C849553ED89B92 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD le_chauffeur_id INT NOT NULL, CHANGE leChauffeur id_chauffeur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558899931 FOREIGN KEY (le_chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_42C849558899931 ON reservation (le_chauffeur_id)');
    }
}
