<?php

namespace App\Entity;

use App\Repository\LikesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikesRepository::class)]
class Likes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberlike = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    #[ORM\OneToMany(mappedBy: 'likes', targetEntity: Ordinateur::class)]
    private Collection $likeOrdinateur;

    #[ORM\OneToMany(mappedBy: 'likes', targetEntity: SmartPhone::class)]
    private Collection $likeSmartphone;

    public function __construct()
    {
        $this->likeOrdinateur = new ArrayCollection();
        $this->likeSmartphone = new ArrayCollection();
        $this->create_at= new \DateTimeImmutable;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberlike(): ?int
    {
        return $this->numberlike;
    }

    public function setNumberlike(int $numberlike): static
    {
        $this->numberlike = $numberlike;

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
     * @return Collection<int, Ordinateur>
     */
    public function getLikeOrdinateur(): Collection
    {
        return $this->likeOrdinateur;
    }

    public function addLikeOrdinateur(Ordinateur $likeOrdinateur): static
    {
        if (!$this->likeOrdinateur->contains($likeOrdinateur)) {
            $this->likeOrdinateur->add($likeOrdinateur);
            $likeOrdinateur->setLikes($this);
        }

        return $this;
    }

    public function removeLikeOrdinateur(Ordinateur $likeOrdinateur): static
    {
        if ($this->likeOrdinateur->removeElement($likeOrdinateur)) {
            // set the owning side to null (unless already changed)
            if ($likeOrdinateur->getLikes() === $this) {
                $likeOrdinateur->setLikes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SmartPhone>
     */
    public function getLikeSmartphone(): Collection
    {
        return $this->likeSmartphone;
    }

    public function addLikeSmartphone(SmartPhone $likeSmartphone): static
    {
        if (!$this->likeSmartphone->contains($likeSmartphone)) {
            $this->likeSmartphone->add($likeSmartphone);
            $likeSmartphone->setLikes($this);
        }

        return $this;
    }

    public function removeLikeSmartphone(SmartPhone $likeSmartphone): static
    {
        if ($this->likeSmartphone->removeElement($likeSmartphone)) {
            // set the owning side to null (unless already changed)
            if ($likeSmartphone->getLikes() === $this) {
                $likeSmartphone->setLikes(null);
            }
        }

        return $this;
    }

   
}
