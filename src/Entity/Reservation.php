<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['chauffeur' => ReservationChauffeur::class, 'forfait' => ReservationForfait::class])]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'reservation:item']),
        new GetCollection(normalizationContext: ['groups' => 'reservation:list'])
    ],
    paginationEnabled: false,
)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?\DateTimeInterface $datereservation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?\DateTimeInterface $dateDebutReservation = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Voiture $laVoiture = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Utilisateur $leClient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): static
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getDateDebutReservation(): ?\DateTimeInterface
    {
        return $this->dateDebutReservation;
    }

    public function setDateDebutReservation(\DateTimeInterface $dateDebutReservation): static
    {
        $this->dateDebutReservation = $dateDebutReservation;

        return $this;
    }

    public function getLaVoiture(): ?Voiture
    {
        return $this->laVoiture;
    }

    public function setLaVoiture(?Voiture $laVoiture): static
    {
        $this->laVoiture = $laVoiture;

        return $this;
    }

    public function getLeClient(): ?Utilisateur
    {
        return $this->leClient;
    }

    public function setLeClient(?Utilisateur $leClient): static
    {
        $this->leClient = $leClient;

        return $this;
    }
}
