<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181028161452 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departamento (id INT AUTO_INCREMENT NOT NULL, ubicacion VARCHAR(100) NOT NULL, cantidad_ambientes INT NOT NULL, metros_cuadrados NUMERIC(10, 0) NOT NULL, valor_noche NUMERIC(10, 0) NOT NULL, valor_mensual NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alquiler (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, departamento_id INT DEFAULT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL, valor_final NUMERIC(10, 0) NOT NULL, INDEX IDX_655BED39DE734E51 (cliente_id), INDEX IDX_655BED395A91C08D (departamento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alquiler ADD CONSTRAINT FK_655BED39DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE alquiler ADD CONSTRAINT FK_655BED395A91C08D FOREIGN KEY (departamento_id) REFERENCES departamento (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE alquiler DROP FOREIGN KEY FK_655BED395A91C08D');
        $this->addSql('ALTER TABLE alquiler DROP FOREIGN KEY FK_655BED39DE734E51');
        $this->addSql('DROP TABLE departamento');
        $this->addSql('DROP TABLE alquiler');
        $this->addSql('DROP TABLE cliente');
    }
}
