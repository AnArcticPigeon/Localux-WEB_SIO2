<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416115830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD destination_depart_id INT NOT NULL, ADD destination_arriver_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FF824EB1 FOREIGN KEY (destination_depart_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557A078AD6 FOREIGN KEY (destination_arriver_id) REFERENCES destination (id)');
        $this->addSql('CREATE INDEX IDX_42C84955FF824EB1 ON reservation (destination_depart_id)');
        $this->addSql('CREATE INDEX IDX_42C849557A078AD6 ON reservation (destination_arriver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FF824EB1');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557A078AD6');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP INDEX IDX_42C84955FF824EB1 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849557A078AD6 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP destination_depart_id, DROP destination_arriver_id');
    }
}
