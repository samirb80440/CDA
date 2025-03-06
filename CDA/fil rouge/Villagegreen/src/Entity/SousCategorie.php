<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieRepository::class)]
class SousCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $imageSousCategorie = null;

    #[ORM\Column(length: 50)]
    private ?string $nomSousCategorie = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'souscategorie')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    /**
     * @var Collection<int, Categorie>
     */
   
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageSousCategorie(): ?string
    {
        return $this->imageSousCategorie;
    }

    public function setImageSousCategorie(string $imageSousCategorie): static
    {
        $this->imageSousCategorie = $imageSousCategorie;

        return $this;
    }

    public function getNomSousCategorie(): ?string
    {
        return $this->nomSousCategorie;
    }

    public function setNomSousCategorie(string $nomSousCategorie): static
    {
        $this->nomSousCategorie = $nomSousCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $produit->setSouscategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getSouscategorie() === $this) {
                $produit->setSouscategorie(null);
            }
        }

        return $this;
    }
   

    
    }

   

        

