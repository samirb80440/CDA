<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Fournisseur $fournisseur = null;

    /**
     * @var Collection<int, Contient>
     */
    #[ORM\OneToMany(targetEntity: Contient::class, mappedBy: 'produit')]
    private Collection $contients;

    /**
     * @var Collection<int, Quantiter>
     */
    #[ORM\OneToMany(targetEntity: Quantiter::class, mappedBy: 'produit')]
    private Collection $quantiters;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?SousCategorie $souscategorie = null;


    public function __construct()
    {
        $this->contients = new ArrayCollection();
        $this->quantiters = new ArrayCollection();
        
    }

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Contient>
     */
    public function getContients(): Collection
    {
        return $this->contients;
    }

    public function addContient(Contient $contient): static
    {
        if (!$this->contients->contains($contient)) {
            $this->contients->add($contient);
            $contient->setProduit($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): static
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getProduit() === $this) {
                $contient->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Quantiter>
     */
    public function getQuantiters(): Collection
    {
        return $this->quantiters;
    }

    public function addQuantiter(Quantiter $quantiter): static
    {
        if (!$this->quantiters->contains($quantiter)) {
            $this->quantiters->add($quantiter);
            $quantiter->setProduit($this);
        }

        return $this;
    }

    public function removeQuantiter(Quantiter $quantiter): static
    {
        if ($this->quantiters->removeElement($quantiter)) {
            // set the owning side to null (unless already changed)
            if ($quantiter->getProduit() === $this) {
                $quantiter->setProduit(null);
            }
        }

        return $this;
    }

    public function getSouscategorie(): ?SousCategorie
    {
        return $this->souscategorie;
    }

    public function setSouscategorie(?SousCategorie $souscategorie): static
    {
        $this->souscategorie = $souscategorie;

        return $this;
    }

   
}
