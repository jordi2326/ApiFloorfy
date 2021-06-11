<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608211840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY idInmueble');
        $this->addSql('CREATE TABLE casa (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE inmueble');
        $this->addSql('DROP TABLE tour');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inmueble (idInmueble INT AUTO_INCREMENT NOT NULL, Titulo VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, Descripcion VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(idInmueble)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tour (idTour INT AUTO_INCREMENT NOT NULL, Activo TINYINT(1) DEFAULT NULL, idInmueble INT NOT NULL, INDEX idInmueble_idx (idInmueble), PRIMARY KEY(idTour)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tour ADD CONSTRAINT idInmueble FOREIGN KEY (idInmueble) REFERENCES inmueble (idInmueble) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE casa');
    }
}
