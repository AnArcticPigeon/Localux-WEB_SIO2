<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416144355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modele_piece (modele_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_E106393CAC14B70A (modele_id), INDEX IDX_E106393CC40FCFA8 (piece_id), PRIMARY KEY(modele_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_degat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modele_piece ADD CONSTRAINT FK_E106393CAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele_piece ADD CONSTRAINT FK_E106393CC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle DROP aile_av_g, DROP aile_ar_g, DROP aile_av_d, DROP aile_ar_d, DROP calandre, DROP phare_av_g, DROP phare_av_d, DROP phare_ar_g, DROP phare_ar_d, DROP siege_cond, DROP siege_pass, DROP tableau_de_bord, DROP porte_av_g, DROP porte_av_d, DROP porte_ar_g, DROP porte_ar_d, DROP coffre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modele_piece DROP FOREIGN KEY FK_E106393CAC14B70A');
        $this->addSql('ALTER TABLE modele_piece DROP FOREIGN KEY FK_E106393CC40FCFA8');
        $this->addSql('DROP TABLE modele_piece');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE type_degat');
        $this->addSql('ALTER TABLE controle ADD aile_av_g VARCHAR(255) DEFAULT NULL, ADD aile_ar_g VARCHAR(255) DEFAULT NULL, ADD aile_av_d VARCHAR(255) DEFAULT NULL, ADD aile_ar_d VARCHAR(255) DEFAULT NULL, ADD calandre VARCHAR(255) DEFAULT NULL, ADD phare_av_g VARCHAR(255) DEFAULT NULL, ADD phare_av_d VARCHAR(255) DEFAULT NULL, ADD phare_ar_g VARCHAR(255) DEFAULT NULL, ADD phare_ar_d VARCHAR(255) DEFAULT NULL, ADD siege_cond VARCHAR(255) DEFAULT NULL, ADD siege_pass VARCHAR(255) DEFAULT NULL, ADD tableau_de_bord VARCHAR(255) DEFAULT NULL, ADD porte_av_g VARCHAR(255) DEFAULT NULL, ADD porte_av_d VARCHAR(255) DEFAULT NULL, ADD porte_ar_g VARCHAR(255) DEFAULT NULL, ADD porte_ar_d VARCHAR(255) DEFAULT NULL, ADD coffre VARCHAR(255) DEFAULT NULL');
    }
}
