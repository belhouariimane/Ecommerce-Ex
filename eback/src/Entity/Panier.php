<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 * @ORM\Table(name="panier" ,schema="public")
 * @ApiResource()
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateLivraison;

    /**
     * @ORM\OneToMany(targetEntity=Variant::class, mappedBy="panier")
     */
    private $variant;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $taille;

    public function __construct()
    {
        $this->variant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(): self
    {
        $this->dateCreation = new \DateTime();

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * @return Collection|variant[]
     */
    public function getVariant(): Collection
    {
        return $this->variant;
    }

    public function addVariant(variant $variant): self
    {
        if (!$this->variant->contains($variant)) {
            $this->variant[] = $variant;
            $variant->setPanier($this);
        }

        return $this;
    }

    public function removeVariant(variant $variant): self
    {
        if ($this->variant->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getPanier() === $this) {
                $variant->setPanier(null);
            }
        }

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }


}
