<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 * @ORM\Table(name="stock" ,schema="public")
 * @ApiResource()
 * @ApiFilter(SearchFilter::class, properties={"taille":"exact","variant":"exact"})
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteDisponible;

    /**
     * @ORM\ManyToMany(targetEntity=Variant::class, inversedBy="stocks")
     */
    private $variant;

    public function __construct()
    {
        $this->variant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantiteDisponible(): ?int
    {
        return $this->quantiteDisponible;
    }

    public function setQuantiteDisponible(int $quantiteDisponible): self
    {
        $this->quantiteDisponible = $quantiteDisponible;

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
        }

        return $this;
    }

    public function removeVariant(variant $variant): self
    {
        $this->variant->removeElement($variant);

        return $this;
    }

}
