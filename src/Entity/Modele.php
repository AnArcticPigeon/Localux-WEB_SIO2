<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'modele:item']),
        new GetCollection(normalizationContext: ['groups' => 'modele:list'])
    ],
    order: ['libelle' => 'ASC'],
    paginationEnabled: false,
)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['modele:list', 'modele:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['modele:list', 'modele:item', 'voiture:list', 'voiture:item'])]
    private ?string $libelle = null;

    #[ORM\Column]
    #[Groups(['modele:list', 'modele:item'])]
    private ?float $prixKiloSup = null;

    #[ORM\Column]
    #[Groups(['modele:list', 'modele:item'])]
    private ?float $prixHeure = null;

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'leModele')]
    #[Groups(['modele:list', 'modele:item'])]
    private Collection $voitures;

    /**
     * @var Collection<int, Piece>
     */
    #[ORM\ManyToMany(targetEntity: Piece::class, inversedBy: 'modeles')]
    #[Groups(['modele:list', 'modele:item'])]
    private Collection $lesPieces;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }
}
