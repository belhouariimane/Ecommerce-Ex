<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 * @ORM\Table(name="stock" ,schema="public")
 * @ApiFilter(SearchFilter::class, properties={"taille":"exact","variant":"exact"})
 * @ApiResource(
 *   normalizationContext={"groups"={"stock:read"}, "enable_max_depth"=true}
 * )
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ({"variant:read","stock:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups ({"variant:read","stock:read"})
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     * @Groups ({"variant:read","stock:read"})
     */
    private $quantiteDisponible;

    /**
     * @ORM\ManyToMany(targetEntity=Variant::class, inversedBy="stocks")
     * @Groups ({"stock:read"})
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
