<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mdp = null;

    /**
     * @var Collection<int, AncienMdp>
     */
    #[ORM\OneToMany(targetEntity: AncienMdp::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $ancienMdp;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'leClient', orphanRemoval: true)]
    private Collection $reservations;

    public function __construct()
    {
        $this->ancienMdp = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(?string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * @return Collection<int, AncienMdp>
     */
    public function getAncienMdp(): Collection
    {
        return $this->ancienMdp;
    }

    public function addAncienMdp(AncienMdp $ancienMdp): static
    {
        if (!$this->ancienMdp->contains($ancienMdp)) {
            $this->ancienMdp->add($ancienMdp);
            $ancienMdp->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAncienMdp(AncienMdp $ancienMdp): static
    {
        if ($this->ancienMdp->removeElement($ancienMdp)) {
            // set the owning side to null (unless already changed)
            if ($ancienMdp->getUtilisateur() === $this) {
                $ancienMdp->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setLeClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getLeClient() === $this) {
                $reservation->setLeClient(null);
            }
        }

        return $this;
    }
}
