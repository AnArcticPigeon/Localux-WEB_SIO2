<?php

namespace App\Entity;

use App\Repository\VerificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VerificationRepository::class)]
class Verification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Piece $idPiece = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeDegat $idDegat = null;

    #[ORM\ManyToOne(inversedBy: 'verifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Controle $idControle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPiece(): ?Piece
    {
        return $this->idPiece;
    }

    public function setIdPiece(?Piece $idPiece): static
    {
        $this->idPiece = $idPiece;

        return $this;
    }

    public function getIdDegat(): ?TypeDegat
    {
        return $this->idDegat;
    }

    public function setIdDegat(?TypeDegat $idDegat): static
    {
        $this->idDegat = $idDegat;

        return $this;
    }

    public function getIdControle(): ?Controle
    {
        return $this->idControle;
    }

    public function setIdControle(?Controle $idControle): static
    {
        $this->idControle = $idControle;

        return $this;
    }
}
