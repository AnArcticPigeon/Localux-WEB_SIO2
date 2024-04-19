<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'utilisateur:item']),
        new GetCollection(normalizationContext: ['groups' => 'utilisateur:list'])
    ],
    order: ['nom' => 'ASC', 'prenom' => 'ASC'],
    paginationEnabled: false,
)]
#[UniqueEntity('email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?int $id = null;

    #[ORM\Column(type: "json")]
    private $roles = [];

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $login = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $mdp = null;

    /**
     * @var Collection<int, AncienMdp>
     */
    #[ORM\OneToMany(targetEntity: AncienMdp::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private Collection $ancienMdp;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'leClient', orphanRemoval: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private Collection $reservations;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $sel = null;

    #[ORM\Column(length: 32, nullable: true)]
    #[Groups(['utilisateur:list', 'utilisateur:item'])]
    private ?string $codeOtp = null;

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

    public function getSel(): ?string
    {
        return $this->sel;
    }

    public function setSel(?string $sel): static
    {
        $this->sel = $sel;

        return $this;
    }

    public function getCodeOtp(): ?string
    {
        return $this->codeOtp;
    }

    public function setCodeOtp(?string $codeOtp): static
    {
        $this->codeOtp = $codeOtp;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setPassword(string $password): self
    {
        $this->mdp = $password;
        return $this;
    }

    //partie Authentification / permisions
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


}
