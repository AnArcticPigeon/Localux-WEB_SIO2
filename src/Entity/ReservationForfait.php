<?php

namespace App\Entity;

use App\Repository\ReservationForfaitRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationForfait::class)]
#[ApiResource(
        operations: [
            new Get(normalizationContext: ['groups' => 'reservation:item']),
            new GetCollection(normalizationContext: ['groups' => 'reservation:list'])
        ],
        paginationEnabled: false,
    )]
class ReservationForfait extends Reservation {

    #[ORM\ManyToOne(inversedBy: 'reservationForfaits')]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Forfait $leForfait = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Controle $leControle = null;

    public function getLeForfait(): ?Forfait
    {
        return $this->leForfait;
    }

    public function setLeForfait(?Forfait $leForfait): static
    {
        $this->leForfait = $leForfait;

        return $this;
    }

    public function getLeControle(): ?Controle
    {
        return $this->leControle;
    }

    public function setLeControle(?Controle $leControle): static
    {
        $this->leControle = $leControle;

        return $this;
    }
}
