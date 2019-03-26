<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
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
    private $code;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;
    
  
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Realiser", mappedBy="test")
     */
    private $realisers;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Liste", mappedBy="test")
     */
    private $listes;

    public function __construct()
    {
        $this->realisers = new ArrayCollection();
        $this->listes = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getRealiser(): ?Realiser
    {
        return $this->realiser;
    }

    public function setRealiser(?Realiser $realiser): self
    {
        $this->realiser = $realiser;

        return $this;
    }

    /**
     * @return Collection|Realiser[]
     */
    public function getRealisers(): Collection
    {
        return $this->realisers;
    }

    public function addRealiser(Realiser $realiser): self
    {
        if (!$this->realisers->contains($realiser)) {
            $this->realisers[] = $realiser;
            $realiser->setTest($this);
        }

        return $this;
    }

    public function removeRealiser(Realiser $realiser): self
    {
        if ($this->realisers->contains($realiser)) {
            $this->realisers->removeElement($realiser);
            // set the owning side to null (unless already changed)
            if ($realiser->getTest() === $this) {
                $realiser->setTest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Liste[]
     */
    public function getListes(): Collection
    {
        return $this->listes;
    }

    public function addListe(Liste $liste): self
    {
        if (!$this->listes->contains($liste)) {
            $this->listes[] = $liste;
            $liste->setTest($this);
        }

        return $this;
    }

    public function removeListe(Liste $liste): self
    {
        if ($this->listes->contains($liste)) {
            $this->listes->removeElement($liste);
            // set the owning side to null (unless already changed)
            if ($liste->getTest() === $this) {
                $liste->setTest(null);
            }
        }

        return $this;
    }
}
