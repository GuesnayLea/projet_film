<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'locations')]
    private Collection $id_utilisateur;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\OneToMany(targetEntity: Film::class, mappedBy: 'location')]
    private Collection $id_film;

    #[ORM\Column]
    private ?\DateTime $date_location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_retour_prevue = null;

    #[ORM\Column]
    private ?float $prix_final = null;

    #[ORM\Column(length: 15)]
    private ?string $statut = null;

    public function __construct()
    {
        $this->id_utilisateur = new ArrayCollection();
        $this->id_film = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getIdUtilisateur(): Collection
    {
        return $this->id_utilisateur;
    }

    public function addIdUtilisateur(Utilisateur $idUtilisateur): static
    {
        if (!$this->id_utilisateur->contains($idUtilisateur)) {
            $this->id_utilisateur->add($idUtilisateur);
        }

        return $this;
    }

    public function removeIdUtilisateur(Utilisateur $idUtilisateur): static
    {
        $this->id_utilisateur->removeElement($idUtilisateur);

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getIdFilm(): Collection
    {
        return $this->id_film;
    }

    public function addIdFilm(Film $idFilm): static
    {
        if (!$this->id_film->contains($idFilm)) {
            $this->id_film->add($idFilm);
            $idFilm->setLocation($this);
        }

        return $this;
    }

    public function removeIdFilm(Film $idFilm): static
    {
        if ($this->id_film->removeElement($idFilm)) {
            // set the owning side to null (unless already changed)
            if ($idFilm->getLocation() === $this) {
                $idFilm->setLocation(null);
            }
        }

        return $this;
    }

    public function getDateLocation(): ?\DateTime
    {
        return $this->date_location;
    }

    public function setDateLocation(\DateTime $date_location): static
    {
        $this->date_location = $date_location;

        return $this;
    }

    public function getDateRetourPrevue(): ?\DateTime
    {
        return $this->date_retour_prevue;
    }

    public function setDateRetourPrevue(\DateTime $date_retour_prevue): static
    {
        $this->date_retour_prevue = $date_retour_prevue;

        return $this;
    }

    public function getPrixFinal(): ?float
    {
        return $this->prix_final;
    }

    public function setPrixFinal(float $prix_final): static
    {
        $this->prix_final = $prix_final;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
