<?php

namespace App\Entity;

use App\Repository\AncienMdpRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AncienMdpRepository::class)]
class AncienMdp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModifMdp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ancienMdp = null;

    #[ORM\ManyToOne(inversedBy: 'ancienMdp')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $otpCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateModifMdp(): ?\DateTimeInterface
    {
        return $this->dateModifMdp;
    }

    public function setDateModifMdp(?\DateTimeInterface $dateModifMdp): static
    {
        $this->dateModifMdp = $dateModifMdp;

        return $this;
    }

    public function getAncienMdp(): ?string
    {
        return $this->ancienMdp;
    }

    public function setAncienMdp(?string $ancienMdp): static
    {
        $this->ancienMdp = $ancienMdp;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getOtpCode(): ?string
    {
        return $this->otpCode;
    }

    public function setOtpCode(?string $otpCode): static
    {
        $this->otpCode = $otpCode;

        return $this;
    }
}
