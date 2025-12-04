<?php

namespace App\Entity;

use App\Repository\TarifDynamiqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifDynamiqueRepository::class)]
class TarifDynamique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $jour_semaine = null;

    #[ORM\Column]
    private ?float $pourcentage_reduction = null;

    #[ORM\Column]
    private ?bool $actif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourSemaine(): ?int
    {
        return $this->jour_semaine;
    }

    public function setJourSemaine(int $jour_semaine): static
    {
        $this->jour_semaine = $jour_semaine;

        return $this;
    }

    public function getPourcentageReduction(): ?float
    {
        return $this->pourcentage_reduction;
    }

    public function setPourcentageReduction(float $pourcentage_reduction): static
    {
        $this->pourcentage_reduction = $pourcentage_reduction;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }
}
