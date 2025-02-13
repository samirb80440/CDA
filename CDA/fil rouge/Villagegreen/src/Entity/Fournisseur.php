<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'fournisseur')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

   

  

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

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }

}
