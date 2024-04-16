<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416131408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552D31EAA1');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849553ED89B92');
        $this->addSql('DROP INDEX IDX_42C849553ED89B92 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849552D31EAA1 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD le_chauffeur_id INT DEFAULT NULL, ADD le_forfait_id INT DEFAULT NULL, DROP leChauffeur, DROP leForfait');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558899931 FOREIGN KEY (le_chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B36D2087 FOREIGN KEY (le_forfait_id) REFERENCES forfait (id)');
        $this->addSql('CREATE INDEX IDX_42C849558899931 ON reservation (le_chauffeur_id)');
        $this->addSql('CREATE INDEX IDX_42C84955B36D2087 ON reservation (le_forfait_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558899931');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B36D2087');
        $this->addSql('DROP INDEX IDX_42C849558899931 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955B36D2087 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD leChauffeur INT DEFAULT NULL, ADD leForfait INT DEFAULT NULL, DROP le_chauffeur_id, DROP le_forfait_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552D31EAA1 FOREIGN KEY (leForfait) REFERENCES forfait (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849553ED89B92 FOREIGN KEY (leChauffeur) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_42C849553ED89B92 ON reservation (leChauffeur)');
        $this->addSql('CREATE INDEX IDX_42C849552D31EAA1 ON reservation (leForfait)');
    }
}
