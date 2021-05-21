<?php

namespace App\Entity;

use App\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=VariantRepository::class)
 * @ORM\Table(name="variant",schema="public")
 * @ApiResource()
 */
class Variant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prixVente;

    /**
     * @ORM\Column(type="array")
     */
    private $tailles = [];

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="variants")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=Couleur::class)
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity=Panier::class, inversedBy="variant")
     */
    private $panier;

    /**
     * @ORM\ManyToMany(targetEntity=Stock::class, mappedBy="variant")
     */
    private $stocks;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getTailles(): ?array
    {
        return $this->tailles;
    }

    public function setTailles(array $tailles): self
    {
        $this->tailles = $tailles;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCouleur(): ?couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->addVariant($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            $stock->removeVariant($this);
        }

        return $this;
    }
}
