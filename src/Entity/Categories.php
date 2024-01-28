<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $Nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    #[ORM\ManyToMany(targetEntity: Ordinateur::class, mappedBy: 'ordinateurcategory')]
    private Collection $ordinateurs;

    #[ORM\ManyToMany(targetEntity: SmartPhone::class, mappedBy: 'smartPhoneCategorie')]
    private Collection $smartPhones;

    public function __construct()
    {
        $this->ordinateurs = new ArrayCollection();
        $this->smartPhones = new ArrayCollection();
        $this->create_at = new \DateTimeImmutable; }

    public function getId(): ?int
    {return $this->id; }

    public function getNom(): ?string
    {return $this->Nom; }

    public function setNom(string $Nom): static
    { $this->Nom = $Nom;
        return $this; }

    public function getCreateAt(): ?\DateTimeImmutable
    {return $this->create_at;}

    public function setCreateAt(\DateTimeImmutable $create_at): static
    { $this->create_at = $create_at;
       return $this; }

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
            $ordinateur->addOrdinateurcategory($this); }
        return $this;}

    public function removeOrdinateur(Ordinateur $ordinateur): static
    {
        if ($this->ordinateurs->removeElement($ordinateur)) {
            $ordinateur->removeOrdinateurcategory($this); }
        return $this;}   

    /** * @return Collection<int, SmartPhone> */
    
    public function getSmartPhones(): Collection
    {
        return $this->smartPhones;}

    public function addSmartPhone(SmartPhone $smartPhone): static
    { if (!$this->smartPhones->contains($smartPhone)) { $this->smartPhones->add($smartPhone); $smartPhone->addSmartPhoneCategorie($this); }
    return $this;}

    public function removeSmartPhone(SmartPhone $smartPhone): static
    {if ($this->smartPhones->removeElement($smartPhone)) { $smartPhone->removeSmartPhoneCategorie($this); }
    return $this;}

    public function __toString()
    { return $this->Nom;}
}
