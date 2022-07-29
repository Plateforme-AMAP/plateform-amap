<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $productName;

    #[ORM\Column(type: 'text', nullable: true)]
    private $productDescription;

    #[ORM\Column(type: 'float')]
    private $productPrice;

    #[ORM\Column(type: 'text', nullable: true)]
    private $productPicture;

    #[ORM\Column(type: 'datetime_immutable')]
    private $productCreatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function setProductDescription(?string $productDescription): self
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getProductPicture(): ?string
    {
        return $this->productPicture;
    }

    public function setProductPicture(?string $productPicture): self
    {
        $this->productPicture = $productPicture;

        return $this;
    }

    public function getProductCreatedAt(): ?\DateTimeImmutable
    {
        return $this->productCreatedAt;
    }

    public function setProductCreatedAt(\DateTimeImmutable $productCreatedAt): self
    {
        $this->productCreatedAt = $productCreatedAt;

        return $this;
    }
    public function getProductUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setProductUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
