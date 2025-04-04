<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: true)]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixAchatCom = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixVenteCom = null;

    #[ORM\Column(nullable: true)]
    private ?bool $conditionReg = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFact = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numFact = null;

    #[ORM\Column(nullable: true)]
    private ?float $reduction = null;

    #[ORM\Column(nullable: true)]
    private ?bool $comExp = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $numCom = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nomCom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCom = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalTtc = null;

    #[ORM\Column(nullable: true)]
    private ?int $tauxTva = null;

    #[ORM\Column(nullable: true)]
    private ?int $prixHtva = null;

    #[ORM\Column(nullable: true)]
    private ?int $indicReduc = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalHtva = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'commandes')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(targetEntity: Bondelivraison::class, inversedBy: 'commande')]
    private ?Bondelivraison $bondelivraison = null;

    #[ORM\OneToMany(targetEntity: Contient::class, mappedBy: 'commande')]
    private Collection $contients;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse_livrai = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse_factu = null;

    public function __construct()
    {
        $this->contients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixAchatCom(): ?float
    {
        return $this->prixAchatCom;
    }

    public function setPrixAchatCom(float $prixAchatCom): static
    {
        $this->prixAchatCom = $prixAchatCom;

        return $this;
    }

    public function getPrixVenteCom(): ?float
    {
        return $this->prixVenteCom;
    }

    public function setPrixVenteCom(float $prixVenteCom): static
    {
        $this->prixVenteCom = $prixVenteCom;

        return $this;
    }

    public function isConditionReg(): ?bool
    {
        return $this->conditionReg;
    }

    public function setConditionReg(bool $conditionReg): static
    {
        $this->conditionReg = $conditionReg;

        return $this;
    }

    public function getDateFact(): ?\DateTimeInterface
    {
        return $this->dateFact;
    }

    public function setDateFact(?\DateTimeInterface $dateFact): static
    {
        $this->dateFact = $dateFact;

        return $this;
    }

    public function getNumFact(): ?string
    {
        return $this->numFact;
    }

    public function setNumFact(?string $numFact): static
    {
        $this->numFact = $numFact;

        return $this;
    }

    public function getReduction(): ?float
    {
        return $this->reduction;
    }

    public function setReduction(float $reduction): static
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function isComExp(): ?bool
    {
        return $this->comExp;
    }

    public function setComExp(bool $comExp): static
    {
        $this->comExp = $comExp;

        return $this;
    }

    public function getNumCom(): ?string
    {
        return $this->numCom;
    }

    public function setNumCom(string $numCom): static
    {
        $this->numCom = $numCom;

        return $this;
    }

    public function getNomCom(): ?string
    {
        return $this->nomCom;
    }

    public function setNomCom(string $nomCom): static
    {
        $this->nomCom = $nomCom;

        return $this;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): static
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    public function getTotalTtc(): ?int
    {
        return $this->totalTtc;
    }

    public function setTotalTtc(int $totalTtc): static
    {
        $this->totalTtc = $totalTtc;

        return $this;
    }

    public function getTauxTva(): ?float
    {
        return $this->tauxTva;
    }

    public function setTauxTva(float $tauxTva): static
    {
        $this->tauxTva = $tauxTva;

        return $this;
    }

   
    

    public function getPrixHtva(): ?int
    {
        return $this->prixHtva;
    }

    public function setPrixHtva(int $prixHtva): static
    {
        $this->prixHtva = $prixHtva;

        return $this;
    }

    public function isIndicReduc(): ?bool
    {
        return $this->indicReduc;
    }

    public function setIndicReduc(bool $indicReduc): static
    {
        $this->indicReduc = $indicReduc;

        return $this;
    }

    public function getTotalHtva(): ?int
    {
        return $this->totalHtva;
    }

    public function setTotalHtva(int $totalHtva): static
    {
        $this->totalHtva = $totalHtva;

        return $this;
    }

    

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

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
            $contient->setCommande($this);
        }

        return $this;
    }

    public function removeContient(Contient $contient): static
    {
        if ($this->contients->removeElement($contient)) {
            // set the owning side to null (unless already changed)
            if ($contient->getCommande() === $this) {
                $contient->setCommande(null);
            }
        }

        return $this;
    }

    public function getAdresseLivrai(): ?string
    {
        return $this->adresse_livrai;
    }

    public function setAdresseLivrai(?string $adresse_livrai): static
    {
        $this->adresse_livrai = $adresse_livrai;

        return $this;
    }

    public function getAdresseFactu(): ?string
    {
        return $this->adresse_factu;
    }

    public function setAdresseFactu(?string $adresse_factu): static
    {
        $this->adresse_factu = $adresse_factu;

        return $this;
    }
}
