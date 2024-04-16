<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416114547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle ADD employe_verif_id INT NOT NULL, ADD aile_av_g VARCHAR(255) DEFAULT NULL, ADD aile_ar_g VARCHAR(255) DEFAULT NULL, ADD aile_av_d VARCHAR(255) DEFAULT NULL, ADD aile_ar_d VARCHAR(255) DEFAULT NULL, ADD calandre VARCHAR(255) DEFAULT NULL, ADD phare_av_g VARCHAR(255) DEFAULT NULL, ADD phare_av_d VARCHAR(255) DEFAULT NULL, ADD phare_ar_g VARCHAR(255) DEFAULT NULL, ADD phare_ar_d VARCHAR(255) DEFAULT NULL, ADD siege_cond VARCHAR(255) DEFAULT NULL, ADD siege_pass VARCHAR(255) DEFAULT NULL, ADD tableau_de_bord VARCHAR(255) DEFAULT NULL, ADD porte_av_g VARCHAR(255) DEFAULT NULL, ADD porte_av_d VARCHAR(255) DEFAULT NULL, ADD porte_ar_g VARCHAR(255) DEFAULT NULL, ADD porte_ar_d VARCHAR(255) DEFAULT NULL, ADD coffre VARCHAR(255) DEFAULT NULL, ADD cout_reparation DOUBLE PRECISION NOT NULL, ADD observation VARCHAR(255) DEFAULT NULL, ADD date_heure DATETIME NOT NULL');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396ECC0DD409 FOREIGN KEY (employe_verif_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_E39396ECC0DD409 ON controle (employe_verif_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle DROP FOREIGN KEY FK_E39396ECC0DD409');
        $this->addSql('DROP INDEX IDX_E39396ECC0DD409 ON controle');
        $this->addSql('ALTER TABLE controle DROP employe_verif_id, DROP aile_av_g, DROP aile_ar_g, DROP aile_av_d, DROP aile_ar_d, DROP calandre, DROP phare_av_g, DROP phare_av_d, DROP phare_ar_g, DROP phare_ar_d, DROP siege_cond, DROP siege_pass, DROP tableau_de_bord, DROP porte_av_g, DROP porte_av_d, DROP porte_ar_g, DROP porte_ar_d, DROP coffre, DROP cout_reparation, DROP observation, DROP date_heure');
    }
}
