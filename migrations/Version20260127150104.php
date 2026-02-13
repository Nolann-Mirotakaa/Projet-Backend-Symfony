<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260127150104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_moto ADD auteur_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_7A8607A60BB6FE6 ON annonce_moto (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_moto DROP FOREIGN KEY FK_7A8607A60BB6FE6');
        $this->addSql('DROP INDEX IDX_7A8607A60BB6FE6 ON annonce_moto');
        $this->addSql('ALTER TABLE annonce_moto DROP auteur_id');
    }
}
