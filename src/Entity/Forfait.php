<?php

namespace App\Entity;

use App\Repository\ForfaitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForfaitRepository::class)]
class Forfait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $nbHeure = null;

    #[ORM\Column]
    private ?int $nbKilometre = null;

    /**
     * @var Collection<int, ReservationForfait>
     */
    #[ORM\OneToMany(targetEntity: ReservationForfait::class, mappedBy: 'leForfait', orphanRemoval: true)]
    private Collection $reservationForfaits;

    public function __construct()
    {
        $this->reservationForfaits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbHeure(): ?float
    {
        return $this->nbHeure;
    }

    public function setNbHeure(float $nbHeure): static
    {
        $this->nbHeure = $nbHeure;

        return $this;
    }

    public function getNbKilometre(): ?int
    {
        return $this->nbKilometre;
    }

    public function setNbKilometre(int $nbKilometre): static
    {
        $this->nbKilometre = $nbKilometre;

        return $this;
    }

    /**
     * @return Collection<int, ReservationForfait>
     */
    public function getReservationForfaits(): Collection
    {
        return $this->reservationForfaits;
    }

    public function addReservationForfait(ReservationForfait $reservationForfait): static
    {
        if (!$this->reservationForfaits->contains($reservationForfait)) {
            $this->reservationForfaits->add($reservationForfait);
            $reservationForfait->setLeForfait($this);
        }

        return $this;
    }

    public function removeReservationForfait(ReservationForfait $reservationForfait): static
    {
        if ($this->reservationForfaits->removeElement($reservationForfait)) {
            // set the owning side to null (unless already changed)
            if ($reservationForfait->getLeForfait() === $this) {
                $reservationForfait->setLeForfait(null);
            }
        }

        return $this;
    }
}
