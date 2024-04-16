<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?float $prixKiloSup = null;

    #[ORM\Column]
    private ?float $prixHeure = null;

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'leModele')]
    private Collection $voitures;

    /**
     * @var Collection<int, Piece>
     */
    #[ORM\ManyToMany(targetEntity: Piece::class, inversedBy: 'modeles')]
    private Collection $lesPieces;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
        $this->lesPieces = new ArrayCollection();
    }

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

    public function getPrixKiloSup(): ?float
    {
        return $this->prixKiloSup;
    }

    public function setPrixKiloSup(float $prixKiloSup): static
    {
        $this->prixKiloSup = $prixKiloSup;

        return $this;
    }

    public function getPrixHeure(): ?float
    {
        return $this->prixHeure;
    }

    public function setPrixHeure(float $prixHeure): static
    {
        $this->prixHeure = $prixHeure;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): static
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setLeModele($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getLeModele() === $this) {
                $voiture->setLeModele(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Piece>
     */
    public function getLesPieces(): Collection
    {
        return $this->lesPieces;
    }

    public function addLesPiece(Piece $lesPiece): static
    {
        if (!$this->lesPieces->contains($lesPiece)) {
            $this->lesPieces->add($lesPiece);
        }

        return $this;
    }

    public function removeLesPiece(Piece $lesPiece): static
    {
        $this->lesPieces->removeElement($lesPiece);

        return $this;
    }

}
