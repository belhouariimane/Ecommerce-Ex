<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521114739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE public.couleur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.panier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.stock_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.couleur (id INT NOT NULL, code INT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.panier (id INT NOT NULL, date_creation DATE NOT NULL, date_livraison DATE NOT NULL, quantite INT NOT NULL, taille VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.produit (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, reference VARCHAR(50) NOT NULL, marque VARCHAR(50) NOT NULL, genre VARCHAR(50) NOT NULL, categorie VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.stock (id INT NOT NULL, taille VARCHAR(255) NOT NULL, quantite_disponible INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE stock_variant (stock_id INT NOT NULL, variant_id INT NOT NULL, PRIMARY KEY(stock_id, variant_id))');
        $this->addSql('CREATE INDEX IDX_E8E5AF0EDCD6110 ON stock_variant (stock_id)');
        $this->addSql('CREATE INDEX IDX_E8E5AF0E3B69A9AF ON stock_variant (variant_id)');
        $this->addSql('CREATE TABLE public.variant (id INT NOT NULL, produit_id INT DEFAULT NULL, couleur_id INT DEFAULT NULL, panier_id INT DEFAULT NULL, prix_vente DOUBLE PRECISION NOT NULL, tailles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CA677111F347EFB ON public.variant (produit_id)');
        $this->addSql('CREATE INDEX IDX_CA677111C31BA576 ON public.variant (couleur_id)');
        $this->addSql('CREATE INDEX IDX_CA677111F77D927C ON public.variant (panier_id)');
        $this->addSql('COMMENT ON COLUMN public.variant.tailles IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE stock_variant ADD CONSTRAINT FK_E8E5AF0EDCD6110 FOREIGN KEY (stock_id) REFERENCES public.stock (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock_variant ADD CONSTRAINT FK_E8E5AF0E3B69A9AF FOREIGN KEY (variant_id) REFERENCES public.variant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.variant ADD CONSTRAINT FK_CA677111F347EFB FOREIGN KEY (produit_id) REFERENCES public.produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.variant ADD CONSTRAINT FK_CA677111C31BA576 FOREIGN KEY (couleur_id) REFERENCES public.couleur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.variant ADD CONSTRAINT FK_CA677111F77D927C FOREIGN KEY (panier_id) REFERENCES public.panier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE public.variant DROP CONSTRAINT FK_CA677111C31BA576');
        $this->addSql('ALTER TABLE public.variant DROP CONSTRAINT FK_CA677111F77D927C');
        $this->addSql('ALTER TABLE public.variant DROP CONSTRAINT FK_CA677111F347EFB');
        $this->addSql('ALTER TABLE stock_variant DROP CONSTRAINT FK_E8E5AF0EDCD6110');
        $this->addSql('ALTER TABLE stock_variant DROP CONSTRAINT FK_E8E5AF0E3B69A9AF');
        $this->addSql('DROP SEQUENCE public.couleur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.panier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.stock_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.variant_id_seq CASCADE');
        $this->addSql('DROP TABLE public.couleur');
        $this->addSql('DROP TABLE public.panier');
        $this->addSql('DROP TABLE public.produit');
        $this->addSql('DROP TABLE public.stock');
        $this->addSql('DROP TABLE stock_variant');
        $this->addSql('DROP TABLE public.variant');
    }
}
