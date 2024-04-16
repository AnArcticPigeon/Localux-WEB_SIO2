<?php

namespace App\Entity;

use App\Repository\ReservationForfaitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationForfait::class)]
class ReservationForfait extends Reservation {

    #[ORM\ManyToOne(inversedBy: 'reservationForfaits')]
    private ?Forfait $leForfait = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
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
