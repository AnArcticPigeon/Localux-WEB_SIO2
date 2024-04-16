<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416152523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE verification (id INT AUTO_INCREMENT NOT NULL, id_piece_id INT NOT NULL, id_degat_id INT NOT NULL, INDEX IDX_5AF1C50B94D4233D (id_piece_id), INDEX IDX_5AF1C50B7428B409 (id_degat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT FK_5AF1C50B94D4233D FOREIGN KEY (id_piece_id) REFERENCES piece (id)');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT FK_5AF1C50B7428B409 FOREIGN KEY (id_degat_id) REFERENCES type_degat (id)');
        $this->addSql('ALTER TABLE controle_piece DROP FOREIGN KEY FK_D780C943C40FCFA8');
        $this->addSql('ALTER TABLE controle_piece DROP FOREIGN KEY FK_D780C943758926A6');
        $this->addSql('DROP TABLE controle_piece');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle_piece (controle_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_D780C943758926A6 (controle_id), INDEX IDX_D780C943C40FCFA8 (piece_id), PRIMARY KEY(controle_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE controle_piece ADD CONSTRAINT FK_D780C943C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controle_piece ADD CONSTRAINT FK_D780C943758926A6 FOREIGN KEY (controle_id) REFERENCES controle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY FK_5AF1C50B94D4233D');
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY FK_5AF1C50B7428B409');
        $this->addSql('DROP TABLE verification');
    }
}
