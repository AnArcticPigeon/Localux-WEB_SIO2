<?php

namespace App\Entity;

use App\Repository\ReservationChauffeurRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: Reservationchauffeur::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'reservation:item']),
        new GetCollection(normalizationContext: ['groups' => 'reservation:list'])
    ],
    paginationEnabled: false,
)]
class ReservationChauffeur extends Reservation
{

    #[ORM\ManyToOne(inversedBy: 'reservationChaufeurs')]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Chauffeur $leChauffeur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Destination $destinationDepart = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn]
    #[Groups(['reservation:list', 'reservation:item'])]
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
