<?php

namespace App\Entity;

use App\Repository\ChauffeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChauffeurRepository::class)]
class Chauffeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, ReservationChauffeur>
     */
    #[ORM\OneToMany(targetEntity: ReservationChauffeur::class, mappedBy: 'leChauffeur', orphanRemoval: true)]
    private Collection $reservationChauffeurs;

    public function __construct()
    {
        $this->reservationChauffeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, ReservationChauffeur>
     */
    public function getReservationChauffeurs(): Collection
    {
        return $this->reservationChauffeurs;
    }

    public function addReservationChauffeur(ReservationChauffeur $reservationChauffeur): static
    {
        if (!$this->reservationChauffeurs->contains($reservationChauffeur)) {
            $this->reservationChauffeurs->add($reservationChauffeur);
            $reservationChauffeur->setLeChauffeur($this);
        }

        return $this;
    }

    public function removeReservationChauffeur(ReservationChauffeur $reservationChauffeur): static
    {
        if ($this->reservationChauffeurs->removeElement($reservationChauffeur)) {
            // set the owning side to null (unless already changed)
            if ($reservationChauffeur->getLeChauffeur() === $this) {
                $reservationChauffeur->setLeChauffeur(null);
            }
        }

        return $this;
    }
}
