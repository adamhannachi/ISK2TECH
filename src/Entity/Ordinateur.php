<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrdinateurRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: OrdinateurRepository::class)]
#[Vich\Uploadable]
class Ordinateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

     // ... other fields

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'property_image', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;



    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $tailleEcran = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $systemeExploitation = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $photoVideo = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $batterie = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $connectivite = null;

    
    
    #[ORM\ManyToOne(inversedBy: 'commentaireOrdinateur')]
    private ?Commentaires $commentaires = null;

    #[ORM\ManyToOne(inversedBy: 'likeOrdinateur')]
    private ?Likes $likes = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'ordinateurs')]
    private Collection $ordinateurcategory;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ordinateurs')]
    private Collection $commandeOrdinateur;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    public function __construct()
    {
        $this->ordinateurcategory = new ArrayCollection();
        $this->commandeOrdinateur = new ArrayCollection();
        $this->create_at = new \DateTimeImmutable;
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

     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTailleEcran(): ?string
    {
        return $this->tailleEcran;
    }

    public function setTailleEcran(?string $tailleEcran): static
    {
        $this->tailleEcran = $tailleEcran;

        return $this;
    }

    public function getSystemeExploitation(): ?string
    {
        return $this->systemeExploitation;
    }

    public function setSystemeExploitation(?string $systemeExploitation): static
    {
        $this->systemeExploitation = $systemeExploitation;

        return $this;
    }

    public function getPhotoVideo(): ?string
    {
        return $this->photoVideo;
    }

    public function setPhotoVideo(?string $photoVideo): static
    {
        $this->photoVideo = $photoVideo;

        return $this;
    }

    public function getBatterie(): ?string
    {
        return $this->batterie;
    }

    public function setBatterie(?string $batterie): static
    {
        $this->batterie = $batterie;

        return $this;
    }

    public function getConnectivite(): ?string
    {
        return $this->connectivite;
    }

    public function setConnectivite(?string $connectivite): static
    {
        $this->connectivite = $connectivite;

        return $this;
    }

   

    public function getCommentaires(): ?Commentaires
    {
        return $this->commentaires;
    }

    public function setCommentaires(?Commentaires $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getLikes(): ?Likes
    {
        return $this->likes;
    }

    public function setLikes(?Likes $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getOrdinateurcategory(): Collection
    {
        return $this->ordinateurcategory;
    }

    public function addOrdinateurcategory(Categories $ordinateurcategory): static
    {
        if (!$this->ordinateurcategory->contains($ordinateurcategory)) {
            $this->ordinateurcategory->add($ordinateurcategory);
        }

        return $this;
    }

    public function removeOrdinateurcategory(Categories $ordinateurcategory): static
    {
        $this->ordinateurcategory->removeElement($ordinateurcategory);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getCommandeOrdinateur(): Collection
    {
        return $this->commandeOrdinateur;
    }

    public function addCommandeOrdinateur(User $commandeOrdinateur): static
    {
        if (!$this->commandeOrdinateur->contains($commandeOrdinateur)) {
            $this->commandeOrdinateur->add($commandeOrdinateur);
        }

        return $this;
    }

    public function removeCommandeOrdinateur(User $commandeOrdinateur): static
    {
        $this->commandeOrdinateur->removeElement($commandeOrdinateur);

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
