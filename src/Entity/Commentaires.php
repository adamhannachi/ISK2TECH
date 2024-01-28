<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentairesRepository::class)]
class Commentaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Note = null;

    #[ORM\OneToMany(mappedBy: 'commentaires', targetEntity: Ordinateur::class)]
    private Collection $commentaireOrdinateur;

    #[ORM\OneToMany(mappedBy: 'commentaires', targetEntity: SmartPhone::class)]
    private Collection $commentaireSmartPhone;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    public function __construct()
    {
        $this->commentaireOrdinateur = new ArrayCollection();
        $this->commentaireSmartPhone = new ArrayCollection();
        $this->create_at= new \DateTimeImmutable;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(?string $Note): static
    {
        $this->Note = $Note;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getCommentaireOrdinateur(): Collection
    {
        return $this->commentaireOrdinateur;
    }

    public function addCommentaireOrdinateur(Ordinateur $commentaireOrdinateur): static
    {
        if (!$this->commentaireOrdinateur->contains($commentaireOrdinateur)) {
            $this->commentaireOrdinateur->add($commentaireOrdinateur);
            $commentaireOrdinateur->setCommentaires($this);
        }

        return $this;
    }

    public function removeCommentaireOrdinateur(Ordinateur $commentaireOrdinateur): static
    {
        if ($this->commentaireOrdinateur->removeElement($commentaireOrdinateur)) {
            // set the owning side to null (unless already changed)
            if ($commentaireOrdinateur->getCommentaires() === $this) {
                $commentaireOrdinateur->setCommentaires(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SmartPhone>
     */
    public function getCommentaireSmartPhone(): Collection
    {
        return $this->commentaireSmartPhone;
    }

    public function addCommentaireSmartPhone(SmartPhone $commentaireSmartPhone): static
    {
        if (!$this->commentaireSmartPhone->contains($commentaireSmartPhone)) {
            $this->commentaireSmartPhone->add($commentaireSmartPhone);
            $commentaireSmartPhone->setCommentaires($this);
        }

        return $this;
    }

    public function removeCommentaireSmartPhone(SmartPhone $commentaireSmartPhone): static
    {
        if ($this->commentaireSmartPhone->removeElement($commentaireSmartPhone)) {
            // set the owning side to null (unless already changed)
            if ($commentaireSmartPhone->getCommentaires() === $this) {
                $commentaireSmartPhone->setCommentaires(null);
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
