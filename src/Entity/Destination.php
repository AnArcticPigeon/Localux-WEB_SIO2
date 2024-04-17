<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ApiResource(
        operations: [
            new Get(normalizationContext: ['groups' => 'destination:item']),
            new GetCollection(normalizationContext: ['groups' => 'destination:list'])
        ],
        order: ['libelle' => 'ASC'],
        paginationEnabled: false,
    )]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['destination:list', 'destination:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['destination:list', 'destination:item'])]
    private ?string $libelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
