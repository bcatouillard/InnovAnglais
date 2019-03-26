<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPayement;
    
    
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeAbonnement", mappedBy="inscription")
     */
    private $typeAbonnements;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="inscriptions")
     */
    private $utilisateur;

    public function __construct()
    {
        $this->typeAbonnements = new ArrayCollection();
        $this->utilisateurs = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPayement(): ?int
    {
        return $this->nbPayement;
    }

    public function setNbPayement(int $nbPayement): self
    {
        $this->nbPayement = $nbPayement;

        return $this;
    }

    /**
     * @return Collection|TypeAbonnement[]
     */
    public function getTypeAbonnements(): Collection
    {
        return $this->typeAbonnements;
    }

    public function addTypeAbonnement(TypeAbonnement $typeAbonnement): self
    {
        if (!$this->typeAbonnements->contains($typeAbonnement)) {
            $this->typeAbonnements[] = $typeAbonnement;
            $typeAbonnement->setInscription($this);
        }

        return $this;
    }

    public function removeTypeAbonnement(TypeAbonnement $typeAbonnement): self
    {
        if ($this->typeAbonnements->contains($typeAbonnement)) {
            $this->typeAbonnements->removeElement($typeAbonnement);
            // set the owning side to null (unless already changed)
            if ($typeAbonnement->getInscription() === $this) {
                $typeAbonnement->setInscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setInscription($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->removeElement($utilisateur);
            // set the owning side to null (unless already changed)
            if ($utilisateur->getInscription() === $this) {
                $utilisateur->setInscription(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
