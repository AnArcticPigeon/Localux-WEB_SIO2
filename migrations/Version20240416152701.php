<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416152701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE verification ADD id_controle_id INT NOT NULL');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT FK_5AF1C50B6D9BEB51 FOREIGN KEY (id_controle_id) REFERENCES controle (id)');
        $this->addSql('CREATE INDEX IDX_5AF1C50B6D9BEB51 ON verification (id_controle_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY FK_5AF1C50B6D9BEB51');
        $this->addSql('DROP INDEX IDX_5AF1C50B6D9BEB51 ON verification');
        $this->addSql('ALTER TABLE verification DROP id_controle_id');
    }
}
