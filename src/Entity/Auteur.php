<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AuteurRepository")
 */
class Auteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",  length=100, unique=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100 )
     *
     */
    private $nationalite;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livre", mappedBy="auteur")
     */
    private $tablivres;

    public function __construct()
    {
        $this->tablivres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getTablivres(): Collection
    {
        return $this->tablivres;
    }

    public function addTablivre(Livre $tablivre): self
    {
        if (!$this->tablivres->contains($tablivre)) {
            $this->tablivres[] = $tablivre;
            $tablivre->setAuteur($this);
        }

        return $this;
    }

    public function removeTablivre(Livre $tablivre): self
    {
        if ($this->tablivres->contains($tablivre)) {
            $this->tablivres->removeElement($tablivre);
            // set the owning side to null (unless already changed)
            if ($tablivre->getAuteur() === $this) {
                $tablivre->setAuteur(null);
            }
        }

        return $this;
    }

   /* public function addTabLivre(Livre $livre): self
    {
        if (!$this->tab_livres->contains($livre)) {
            $this->tab_livres[] = $livre;
            $livre->setAuteur($this);
        }

        return $this;
    }

    public function removeTabLivre(Livre $livre): self
    {
        if ($this->tab_livres->contains($livre)) {
            $this->tab_livres->removeElement($livre);
            // set the owning side to null (unless already changed)
            if ($livre->getAuteur() === $this) {
                $livre->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */

}
