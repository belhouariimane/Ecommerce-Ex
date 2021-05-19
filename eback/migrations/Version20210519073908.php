<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519073908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE couleur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE panier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stock_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE couleur (id INT NOT NULL, code INT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE panier (id INT NOT NULL, date_creation DATE NOT NULL, date_livraison DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.produit (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, reference VARCHAR(50) NOT NULL, marque VARCHAR(50) NOT NULL, genre VARCHAR(50) NOT NULL, categorie VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE stock (id INT NOT NULL, taille INT NOT NULL, quantite_disponible INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE variant (id INT NOT NULL, produit_id INT DEFAULT NULL, couleur_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, panier_id INT DEFAULT NULL, prix_vente DOUBLE PRECISION NOT NULL, tailles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F143BFADF347EFB ON variant (produit_id)');
        $this->addSql('CREATE INDEX IDX_F143BFADC31BA576 ON variant (couleur_id)');
        $this->addSql('CREATE INDEX IDX_F143BFADDCD6110 ON variant (stock_id)');
        $this->addSql('CREATE INDEX IDX_F143BFADF77D927C ON variant (panier_id)');
        $this->addSql('COMMENT ON COLUMN variant.tailles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE variant ADD CONSTRAINT FK_F143BFADF347EFB FOREIGN KEY (produit_id) REFERENCES public.produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variant ADD CONSTRAINT FK_F143BFADC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variant ADD CONSTRAINT FK_F143BFADDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE variant ADD CONSTRAINT FK_F143BFADF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE variant DROP CONSTRAINT FK_F143BFADC31BA576');
        $this->addSql('ALTER TABLE variant DROP CONSTRAINT FK_F143BFADF77D927C');
        $this->addSql('ALTER TABLE variant DROP CONSTRAINT FK_F143BFADF347EFB');
        $this->addSql('ALTER TABLE variant DROP CONSTRAINT FK_F143BFADDCD6110');
        $this->addSql('DROP SEQUENCE couleur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE panier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stock_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE variant_id_seq CASCADE');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE public.produit');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE variant');
    }
}
