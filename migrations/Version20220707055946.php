<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707055946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD surface INT NOT NULL, ADD rooms SMALLINT NOT NULL, ADD bedroom SMALLINT NOT NULL, ADD floor SMALLINT NOT NULL, ADD price INT NOT NULL, ADD heat INT NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD postal_code VARCHAR(255) NOT NULL, ADD sold TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP surface, DROP rooms, DROP bedroom, DROP floor, DROP price, DROP heat, DROP city, DROP address, DROP postal_code, DROP sold, DROP created_at');
    }
}
