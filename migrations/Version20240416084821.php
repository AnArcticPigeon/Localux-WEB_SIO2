<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416084821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD idVoiture INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F95BEAFD FOREIGN KEY (idVoiture) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_42C84955F95BEAFD ON reservation (idVoiture)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F95BEAFD');
        $this->addSql('DROP INDEX IDX_42C84955F95BEAFD ON reservation');
        $this->addSql('ALTER TABLE reservation DROP idVoiture');
    }
}
