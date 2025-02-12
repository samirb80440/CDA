<?php

namespace App\Entity;

use App\Repository\BondelivraisonRepository;
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
}
