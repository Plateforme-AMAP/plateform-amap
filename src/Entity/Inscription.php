<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 200)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 200)]
    private $adress;

    #[ORM\Column(type: 'string', length: 5)]
    private $zipCode;

    #[ORM\Column(type: 'string', length: 150)]
    private $city;

    #[ORM\Column(type: 'string', length: 150)]
    private $email;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $phoneNumber;

    #[ORM\Column(type: 'string', length: 100)]
    private $basket;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $bonusProduct;

    #[ORM\Column(type: 'boolean')]
    private $member;

    #[ORM\Column(type: 'boolean')]
    private $generalCommitments;

    #[ORM\Column(type: 'string', length: 150)]
    private $payment;

    #[ORM\Column(type: 'datetime_immutable')]
    private $inscriptionCreatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getBasket(): ?string
    {
        return $this->basket;
    }

    public function setBasket(string $basket): self
    {
        $this->basket = $basket;

        return $this;
    }

    public function getBonusProduct(): ?string
    {
        return $this->bonusProduct;
    }

    public function setBonusProduct(?string $bonusProduct): self
    {
        $this->bonusProduct = $bonusProduct;

        return $this;
    }

    public function isMember(): ?bool
    {
        return $this->member;
    }

    public function setMember(bool $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function isGeneralCommitments(): ?bool
    {
        return $this->generalCommitments;
    }

    public function setGeneralCommitments(bool $generalCommitments): self
    {
        $this->generalCommitments = $generalCommitments;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getInscriptionCreatedAt(): ?\DateTimeImmutable
    {
        return $this->inscriptionCreatedAt;
    }

    public function setInscriptionCreatedAt(\DateTimeImmutable $inscriptionCreatedAt): self
    {
        $this->inscriptionCreatedAt = $inscriptionCreatedAt;

        return $this;
    }
}
