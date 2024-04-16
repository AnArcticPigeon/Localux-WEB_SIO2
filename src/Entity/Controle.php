<?php

namespace App\Entity;

use App\Repository\ControleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ControleRepository::class)]
class Controle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?float $coutReparation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeure = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $employeVerif = null;

    /**
     * @var Collection<int, Verification>
     */
    #[ORM\OneToMany(targetEntity: Verification::class, mappedBy: 'idControle', orphanRemoval: true)]
    private Collection $verifications;

    public function __construct()
    {
        $this->verifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoutReparation(): ?float
    {
        return $this->coutReparation;
    }

    public function setCoutReparation(?float $coutReparation): static
    {
        $this->coutReparation = $coutReparation;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): static
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    public function getEmployeVerif(): ?Utilisateur
    {
        return $this->employeVerif;
    }

    public function setEmployeVerif(?Utilisateur $employeVerif): static
    {
        $this->employeVerif = $employeVerif;

        return $this;
    }

    /**
     * @return Collection<int, Verification>
     */
    public function getVerifications(): Collection
    {
        return $this->verifications;
    }

    public function addVerification(Verification $verification): static
    {
        if (!$this->verifications->contains($verification)) {
            $this->verifications->add($verification);
            $verification->setIdControle($this);
        }

        return $this;
    }

    public function removeVerification(Verification $verification): static
    {
        if ($this->verifications->removeElement($verification)) {
            // set the owning side to null (unless already changed)
            if ($verification->getIdControle() === $this) {
                $verification->setIdControle(null);
            }
        }

        return $this;
    }

}
