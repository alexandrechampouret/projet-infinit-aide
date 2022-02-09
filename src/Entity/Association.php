<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass= AssociationRepository::class)
 */
class Association
{
    /** 
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type= 'integer')
    */
    private $id;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $nom;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $adresse;

    /**
     * @ORM\Column(type= 'integer')
     */
    private $numero;

    /**
     * @ORM\Column(type= 'string', length= 255, nullable=true)
     */
    private $mail;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
}
