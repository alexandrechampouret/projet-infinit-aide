<?php

namespace App\Entity;

use App\Repository\CalendrierDemarchesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass= CalendrierDemarchesRepository::class)
 */
class CalendrierDemarches
{
    /** 
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type= 'integer')
    */
    private $id;

    /**
     * @ORM\Column(type= 'datetime')
     */
    private $dateDeces;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $nomPrenomDeces;

    /**
     * @ORM\OneToOne(inversedBy= 'calendrierDemarches', targetEntity= User::class, cascade= {'persist', 'remove'})
    * @ORM\JoinColumn(nullable= false)
    */
    private $relatedUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getNomPrenomDeces(): ?string
    {
        return $this->nomPrenomDeces;
    }

    public function setNomPrenomDeces(string $nomPrenomDeces): self
    {
        $this->nomPrenomDeces = $nomPrenomDeces;

        return $this;
    }

    public function getRelatedUser(): ?User
    {
        return $this->relatedUser;
    }

    public function setRelatedUser(User $relatedUser): self
    {
        $this->relatedUser = $relatedUser;

        return $this;
    }
}
