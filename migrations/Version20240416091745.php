<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416091745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ancien_mdp (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, date_modif_mdp DATETIME DEFAULT NULL, ancien_mdp VARCHAR(255) DEFAULT NULL, INDEX IDX_F58A3CBDFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ancien_mdp ADD CONSTRAINT FK_F58A3CBDFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F95BEAFD');
        $this->addSql('DROP INDEX IDX_42C84955F95BEAFD ON reservation');
        $this->addSql('ALTER TABLE reservation ADD la_voiture_id INT NOT NULL, DROP idVoiture');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552187EC6E FOREIGN KEY (la_voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_42C849552187EC6E ON reservation (la_voiture_id)');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F73132DC2');
        $this->addSql('DROP INDEX IDX_E9E2810F73132DC2 ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE idModele le_modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F750CA3FD FOREIGN KEY (le_modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F750CA3FD ON voiture (le_modele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ancien_mdp DROP FOREIGN KEY FK_F58A3CBDFB88E14F');
        $this->addSql('DROP TABLE ancien_mdp');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F750CA3FD');
        $this->addSql('DROP INDEX IDX_E9E2810F750CA3FD ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE le_modele_id idModele INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F73132DC2 FOREIGN KEY (idModele) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F73132DC2 ON voiture (idModele)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552187EC6E');
        $this->addSql('DROP INDEX IDX_42C849552187EC6E ON reservation');
        $this->addSql('ALTER TABLE reservation ADD idVoiture INT DEFAULT NULL, DROP la_voiture_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F95BEAFD FOREIGN KEY (idVoiture) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_42C84955F95BEAFD ON reservation (idVoiture)');
    }
}
