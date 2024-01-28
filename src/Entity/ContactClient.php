<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContactClientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ContactClientRepository::class)]
class ContactClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $numberPhone = null;

    #[ORM\Column(length: 255)]
    private ?string $sujet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\OneToMany(mappedBy: 'contactClient', targetEntity: User::class)]
    private Collection $contactparticulier;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    public function __construct()
    {
        $this->contactparticulier = new ArrayCollection();
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNumberPhone(): ?string
    {
        return $this->numberPhone;
    }

    public function setNumberPhone(string $numberPhone): static
    {
        $this->numberPhone = $numberPhone;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getContactparticulier(): Collection
    {
        return $this->contactparticulier;
    }

    public function addContactparticulier(User $contactparticulier): static
    {
        if (!$this->contactparticulier->contains($contactparticulier)) {
            $this->contactparticulier->add($contactparticulier);
            $contactparticulier->setContactClient($this);
        }

        return $this;
    }

    public function removeContactparticulier(User $contactparticulier): static
    {
        if ($this->contactparticulier->removeElement($contactparticulier)) {
            // set the owning side to null (unless already changed)
            if ($contactparticulier->getContactClient() === $this) {
                $contactparticulier->setContactClient(null);
            }
        }

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

   


}
