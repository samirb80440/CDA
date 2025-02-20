<?php

namespace App\Entity;

use App\Repository\QuantiterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuantiterRepository::class)]
class Quantiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'quantiters')]
    #[ORM\JoinColumn(name: "Id_Bon_de_livraison", referencedColumnName: "id")]
    private ?Bondelivraison $bondelivraison = null;

    #[ORM\ManyToOne(inversedBy: 'quantiters')]
    #[ORM\JoinColumn(name: "Id_Produit", referencedColumnName: "id")]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getBondelivraison(): ?Bondelivraison
    {
        return $this->bondelivraison;
    }

    public function setBondelivraison(?Bondelivraison $bondelivraison): static
    {
        $this->bondelivraison = $bondelivraison;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
