<?php

namespace App\Entity;

use App\Repository\ReservationChauffeurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Reservationchauffeur::class)]
class ReservationChauffeur extends Reservation {

    #[ORM\ManyToOne(inversedBy: 'reservationChaufeurs')]
    private ?Chauffeur $leChauffeur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Destination $destinationDepart = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Destination $destinationArriver = null;

    public function getLechauffeur(): ?Chauffeur
    {
        return $this->leChauffeur;
    }

    public function setLeChauffeur(?Chauffeur $leChauffeur): static
    {
        $this->leChauffeur = $leChauffeur;

        return $this;
    }

    public function getDestinationDepart(): ?Destination
    {
        return $this->destinationDepart;
    }

    public function setDestinationDepart(?Destination $destinationDepart): static
    {
        $this->destinationDepart = $destinationDepart;

        return $this;
    }

    public function getDestinationArriver(): ?Destination
    {
        return $this->destinationArriver;
    }

    public function setDestinationArriver(?Destination $destinationArriver): static
    {
        $this->destinationArriver = $destinationArriver;

        return $this;
    }
}
