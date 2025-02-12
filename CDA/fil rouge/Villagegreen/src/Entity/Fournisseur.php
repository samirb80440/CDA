<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomFournisseur = null;

    #[ORM\Column(length: 100)]
    private ?string $contactFournisseur = null;

    #[ORM\Column(length: 150)]
    private ?string $adresseFournisseur = null;

    #[ORM\Column(length: 10)]
    private ?string $telephoneFournisseur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->nomFournisseur;
    }

    public function setNomFournisseur(string $nomFournisseur): static
    {
        $this->nomFournisseur = $nomFournisseur;

        return $this;
    }

    public function getContactFournisseur(): ?string
    {
        return $this->contactFournisseur;
    }

    public function setContactFournisseur(string $contactFournisseur): static
    {
        $this->contactFournisseur = $contactFournisseur;

        return $this;
    }

    public function getAdresseFournisseur(): ?string
    {
        return $this->adresseFournisseur;
    }

    public function setAdresseFournisseur(string $adresseFournisseur): static
    {
        $this->adresseFournisseur = $adresseFournisseur;

        return $this;
    }

    public function getTelephoneFournisseur(): ?string
    {
        return $this->telephoneFournisseur;
    }

    public function setTelephoneFournisseur(string $telephoneFournisseur): static
    {
        $this->telephoneFournisseur = $telephoneFournisseur;

        return $this;
    }
}
