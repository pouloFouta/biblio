<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivreRepository")
 */
class Livre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $annee;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbpages;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Auteur" , inversedBy ="tab_livres"))
     * @ORM\JoinColumn(nullable=false)
     */

    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Biblio", inversedBy=" listeslivres")
     *
     */

    private $biblio;

    public function __construct()
    {


        $tab_arguments = func_get_args();
        $nbrArguments = func_num_args();
        switch($nbrArguments)
        {
            case 0 :
                break;
            case 2 : $this->__construct1($tab_arguments[0],
                $tab_arguments[1]);
                break;
            case 3 : $this->__construct2($tab_arguments);
                break;
        }
    }

    private function __construct1($titre, $genre)
    {
        $this->titre = $titre;
        $this->genre = $genre;
        $this->annee = 2019;
    }

    private function __construct2($livre)
    {
        $this->titre = $livre[0];
        $this->genre = $livre[1];
        $this->annee = $livre[2];
    }


    /**
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAnnee():? \DateTime
    {
        return $this->annee;
    }

    public function setAnnee(\Datetime $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNbpages(): ?int
    {
        return $this->nbpages;
    }

    public function setNbpages(int $nbpages): self
    {
        $this->nbpages = $nbpages;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getBiblio(): ?Biblio
    {
        return $this->biblio;
    }

    public function setBiblio(?Biblio $biblio): self
    {
        $this->biblio = $biblio;

        return $this;
    }
}
