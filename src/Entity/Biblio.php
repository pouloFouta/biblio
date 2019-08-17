<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Livre;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BiblioRepository")
 */
class Biblio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $lieu;




    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livre", mappedBy="biblio")
     *@ORM\JoinColumn(nullable=true)
     */


    private $listeslivres;


    public function __construct()
    {
        $this->listeslivres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getListeslivres()
    {
        return $this->listeslivres;

       }


    public function addListeslivre(Livre $listeslivre): self
    {
        if (!$this->listeslivres->contains($listeslivre)) {
            $this->listeslivres[] = $listeslivre;
            $listeslivre->setBiblio($this);
        }

        return $this;
    }

    public function removeListeslivre(Livre $listeslivre): self
    {
        if ($this->listeslivres->contains($listeslivre)) {
            $this->listeslivres->removeElement($listeslivre);
            // set the owning side to null (unless already changed)
            if ($listeslivre->getBiblio() === $this) {
                $listeslivre->setBiblio(null);
            }
        }

        return $this;
    }


}
