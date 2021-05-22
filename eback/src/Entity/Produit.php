<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ORM\Table(name="produit" ,schema="public")
 * @ApiResource(
 *     normalizationContext={"groups"={"produit:read"}, "enable_max_depth"=true}
 *     )
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"variant:read","produit:read","stock:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups ({"variant:read","produit:read","stock:read"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups ({"variant:read","produit:read"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups ({"variant:read","produit:read","stock:read"})
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups ({"variant:read","produit:read","stock:read"})
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups ({"variant:read","produit:read","stock:read"})
     */

    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Variant::class, mappedBy="produit")
     * @Groups ({"produit:read"})
     */
    private $variants;

    public function __construct()
    {
        $this->variants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|variant[]
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(variant $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants[] = $variant;
            $variant->setProduit($this);
        }

        return $this;
    }

    public function removeVariant(variant $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProduit() === $this) {
                $variant->setProduit(null);
            }
        }

        return $this;
    }
}
