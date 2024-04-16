<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416145452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle_type_degat (controle_id INT NOT NULL, type_degat_id INT NOT NULL, INDEX IDX_AC65143F758926A6 (controle_id), INDEX IDX_AC65143FE90C7F60 (type_degat_id), PRIMARY KEY(controle_id, type_degat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controle_type_degat ADD CONSTRAINT FK_AC65143F758926A6 FOREIGN KEY (controle_id) REFERENCES controle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_type_degat ADD CONSTRAINT FK_AC65143FE90C7F60 FOREIGN KEY (type_degat_id) REFERENCES type_degat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_type_degat DROP FOREIGN KEY FK_CA9933A8E90C7F60');
        $this->addSql('ALTER TABLE piece_type_degat DROP FOREIGN KEY FK_CA9933A8C40FCFA8');
        $this->addSql('DROP TABLE piece_type_degat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE piece_type_degat (piece_id INT NOT NULL, type_degat_id INT NOT NULL, INDEX IDX_CA9933A8E90C7F60 (type_degat_id), INDEX IDX_CA9933A8C40FCFA8 (piece_id), PRIMARY KEY(piece_id, type_degat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE piece_type_degat ADD CONSTRAINT FK_CA9933A8E90C7F60 FOREIGN KEY (type_degat_id) REFERENCES type_degat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piece_type_degat ADD CONSTRAINT FK_CA9933A8C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_type_degat DROP FOREIGN KEY FK_AC65143F758926A6');
        $this->addSql('ALTER TABLE controle_type_degat DROP FOREIGN KEY FK_AC65143FE90C7F60');
        $this->addSql('DROP TABLE controle_type_degat');
    }
}
