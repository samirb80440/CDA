<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180,nullable: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'utilisateur')]
    private Collection $commande;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nomcli = null;

    #[ORM\Column(nullable: true)]
    private ?int $catecli = null;

    #[ORM\Column(nullable: true)]
    private ?int $coeffcli = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $numtelephone = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomcli = null;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'utilisateur')]
    private Collection $contacts;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresselivrai = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adressefactu = null;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

  

 


  

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commande->contains($commande)) {
            $this->commande->add($commande);
            $commande->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUtilisateur() === $this) {
                $commande->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getNomcli(): ?string
    {
        return $this->nomcli;
    }

    public function setNomcli(?string $nomcli): static
    {
        $this->nomcli = $nomcli;

        return $this;
    }

    public function isCatecli(): ?bool
    {
        return $this->catecli;
    }

    public function setCatecli(?bool $catecli): static
    {
        $this->catecli = $catecli;

        return $this;
    }

    public function getCoeffcli(): ?int
    {
        return $this->coeffcli;
    }

    public function setCoeffcli(?int $coeffcli): static
    {
        $this->coeffcli = $coeffcli;

        return $this;
    }

    public function getNumtelephone(): ?string
    {
        return $this->numtelephone;
    }

    public function setNumtelephone(?string $numtelephone): static
    {
        $this->numtelephone = $numtelephone;

        return $this;
    }

    public function getPrenomcli(): ?string
    {
        return $this->prenomcli;
    }

    public function setPrenomcli(string $prenomcli): static
    {
        $this->prenomcli = $prenomcli;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setUtilisateur($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUtilisateur() === $this) {
                $contact->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getAdresseLivrai(): ?string
    {
        return $this->adresselivrai;
    }

    public function setAdresseLivrai(?string $adresse_livrai): static
    {
        $this->adresselivrai = $adresse_livrai;

        return $this;
    }

    public function getAdresseFactu(): ?string
    {
        return $this->adressefactu;
    }

    public function setAdresseFactu(?string $adresse_factu): static
    {
        $this->adressefactu = $adresse_factu;

        return $this;
    }
}
