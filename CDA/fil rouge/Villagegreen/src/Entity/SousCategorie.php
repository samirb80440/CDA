<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
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
}
