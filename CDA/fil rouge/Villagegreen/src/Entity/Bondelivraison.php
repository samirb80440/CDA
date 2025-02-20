<?php

namespace App\Entity;

use App\Repository\BondelivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BondelivraisonRepository::class)]
class Bondelivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $numLivrais = null;

    #[ORM\Column(length: 50)]
    private ?string $logoEntreprise = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLivCom = null;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'bondelivraison')]
    private Collection $commande;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumLivrais(): ?string
    {
        return $this->numLivrais;
    }

    public function setNumLivrais(string $numLivrais): static
    {
        $this->numLivrais = $numLivrais;

        return $this;
    }

    public function getLogoEntreprise(): ?string
    {
        return $this->logoEntreprise;
    }

    public function setLogoEntreprise(string $logoEntreprise): static
    {
        $this->logoEntreprise = $logoEntreprise;

        return $this;
    }

    public function getDateLivCom(): ?\DateTimeInterface
    {
        return $this->dateLivCom;
    }

    public function setDateLivCom(\DateTimeInterface $dateLivCom): static
    {
        $this->dateLivCom = $dateLivCom;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commande->contains($commande)) {
            $this->commande->add($commande);
            $commande->setBondelivraison($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getBondelivraison() === $this) {
                $commande->setBondelivraison(null);
            }
        }

        return $this;
    }
}
