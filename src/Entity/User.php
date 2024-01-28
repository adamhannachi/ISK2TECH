<?php

namespace App\Entity;

use App\Entity\Ordinateur;
use App\Entity\SmartPhone;
use App\Entity\Accessoires;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface ;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

class User implements UserInterface, PasswordAuthenticatedUserInterface 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    /** basic constraints */
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
   
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
   
    private ?string $password = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank]
    private ?string $firstName = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank] /**basic contraints */
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $adressePostale = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $NumberPhone = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    #[ORM\ManyToMany(targetEntity: Accessoires::class, mappedBy: 'commande')]
    private Collection $accessoires;

    #[ORM\ManyToOne(inversedBy: 'contactparticulier')]
    private ?ContactClient $contactClient = null;

    #[ORM\ManyToMany(targetEntity: Ordinateur::class, mappedBy: 'commandeOrdinateur')]
    private Collection $ordinateurs;

    #[ORM\ManyToMany(targetEntity: SmartPhone::class, mappedBy: 'commandeSmartPhone')]
    private Collection $smartPhones;

    public function __construct()
    {
        $this->accessoires = new ArrayCollection();
        $this->ordinateurs = new ArrayCollection();
        $this->smartPhones = new ArrayCollection();
        $this->create_at= new \DateTimeImmutable;
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
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAdressePostale(): ?string
    {
        return $this->adressePostale;
    }

    public function setAdressePostale(string $adressePostale): static
    {
        $this->adressePostale = $adressePostale;

        return $this;
    }

    public function getNumberPhone(): ?string
    {
        return $this->NumberPhone;
    }

    public function setNumberPhone(string $NumberPhone): static
    {
        $this->NumberPhone = $NumberPhone;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeImmutable $create_at): static
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * @return Collection<int, Accessoires>
     */
    public function getAccessoires(): Collection
    {
        return $this->accessoires;
    }

    public function addAccessoire(Accessoires $accessoire): static
    {
        if (!$this->accessoires->contains($accessoire)) {
            $this->accessoires->add($accessoire);
            $accessoire->addCommande($this);
        }

        return $this;
    }

    public function removeAccessoire(Accessoires $accessoire): static
    {
        if ($this->accessoires->removeElement($accessoire)) {
            $accessoire->removeCommande($this);
        }

        return $this;
    }

    public function getContactClient(): ?ContactClient
    {
        return $this->contactClient;
    }

    public function setContactClient(?ContactClient $contactClient): static
    {
        $this->contactClient = $contactClient;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getOrdinateurs(): Collection
    {
        return $this->ordinateurs;
    }

    public function addOrdinateur(Ordinateur $ordinateur): static
    {
        if (!$this->ordinateurs->contains($ordinateur)) {
            $this->ordinateurs->add($ordinateur);
            $ordinateur->addCommandeOrdinateur($this);
        }

        return $this;
    }

    public function removeOrdinateur(Ordinateur $ordinateur): static
    {
        if ($this->ordinateurs->removeElement($ordinateur)) {
            $ordinateur->removeCommandeOrdinateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, SmartPhone>
     */
    public function getSmartPhones(): Collection
    {
        return $this->smartPhones;
    }

    public function addSmartPhone(SmartPhone $smartPhone): static
    {
        if (!$this->smartPhones->contains($smartPhone)) {
            $this->smartPhones->add($smartPhone);
            $smartPhone->addCommandeSmartPhone($this);
        }

        return $this;
    }

    public function removeSmartPhone(SmartPhone $smartPhone): static
    {
        if ($this->smartPhones->removeElement($smartPhone)) {
            $smartPhone->removeCommandeSmartPhone($this);
        }

        return $this;
    }
}
