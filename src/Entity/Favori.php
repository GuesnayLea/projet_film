<?php

namespace App\Entity;

use App\Repository\FavoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriRepository::class)]
class Favori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'favoris')]
    private Collection $id_utilisateur;

    /**
     * @var Collection<int, Film>
     */
    #[ORM\ManyToMany(targetEntity: Film::class, inversedBy: 'favoris')]
    private Collection $id_film;

    #[ORM\Column]
    private ?\DateTime $date_ajout = null;

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
        }

        return $this;
    }

    public function removeIdFilm(Film $idFilm): static
    {
        $this->id_film->removeElement($idFilm);

        return $this;
    }

    public function getDateAjout(): ?\DateTime
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTime $date_ajout): static
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }
}
