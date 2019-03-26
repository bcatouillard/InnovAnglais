<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListeRepository")
 */
class Liste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Test", inversedBy="listes")
     */
    private $test;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="listes")
     */
    private $entreprise;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vocabulaire", inversedBy="listes")
     */
    private $vocabulaire;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="listes")
     */
    private $theme;
     
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getVocabulaire(): ?Vocabulaire
    {
        return $this->vocabulaire;
    }

    public function setVocabulaire(?Vocabulaire $vocabulaire): self
    {
        $this->vocabulaire = $vocabulaire;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
