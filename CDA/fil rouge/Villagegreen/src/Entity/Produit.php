<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $prixAchat = null;

    #[ORM\Column(length: 100)]
    private ?string $nomProd = null;

    #[ORM\Column]
    private ?int $stockprod = null;

    #[ORM\Column(length: 150)]
    private ?string $photoProduit = null;

    #[ORM\Column(length: 50)]
    private ?string $LibCourtProd = null;

    #[ORM\Column(length: 200)]
    private ?string $libLongProd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixAchat(): ?int
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(int $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getNomProd(): ?string
    {
        return $this->nomProd;
    }

    public function setNomProd(string $nomProd): static
    {
        $this->nomProd = $nomProd;

        return $this;
    }

    public function getStockprod(): ?int
    {
        return $this->stockprod;
    }

    public function setStockprod(int $stockprod): static
    {
        $this->stockprod = $stockprod;

        return $this;
    }

    public function getPhotoProduit(): ?string
    {
        return $this->photoProduit;
    }

    public function setPhotoProduit(string $photoProduit): static
    {
        $this->photoProduit = $photoProduit;

        return $this;
    }

    public function getLibCourtProd(): ?string
    {
        return $this->LibCourtProd;
    }

    public function setLibCourtProd(string $LibCourtProd): static
    {
        $this->LibCourtProd = $LibCourtProd;

        return $this;
    }

    public function getLibLongProd(): ?string
    {
        return $this->libLongProd;
    }

    public function setLibLongProd(string $libLongProd): static
    {
        $this->libLongProd = $libLongProd;

        return $this;
    }
}
