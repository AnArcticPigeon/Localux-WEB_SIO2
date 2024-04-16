<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416112609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP laVoiture, DROP leClient');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552187EC6E FOREIGN KEY (la_voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C0F37DD6 FOREIGN KEY (le_client_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_42C849552187EC6E ON reservation (la_voiture_id)');
        $this->addSql('CREATE INDEX IDX_42C84955C0F37DD6 ON reservation (le_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552187EC6E');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C0F37DD6');
        $this->addSql('DROP INDEX IDX_42C849552187EC6E ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955C0F37DD6 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD laVoiture INT DEFAULT NULL, ADD leClient INT DEFAULT NULL');
    }
}
