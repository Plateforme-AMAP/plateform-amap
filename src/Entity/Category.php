<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Products::class)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Unity::class)]
    private $unity;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->unity = new ArrayCollection();
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

    /**
     * @return Collection<int, Products>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Unity>
     */
    public function getUnity(): Collection
    {
        return $this->unity;
    }

    public function addUnity(Unity $unity): self
    {
        if (!$this->unity->contains($unity)) {
            $this->unity[] = $unity;
            $unity->setCategory($this);
        }

        return $this;
    }

    public function removeUnity(Unity $unity): self
    {
        if ($this->unity->removeElement($unity)) {
            // set the owning side to null (unless already changed)
            if ($unity->getCategory() === $this) {
                $unity->setCategory(null);
            }
        }

        return $this;
    }
}
