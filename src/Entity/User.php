<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass= UserRepository::class)
 */
class User
{
    /** 
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type= 'integer')
    */
    private $id;

    /**
     * @ORM\Column(type= 'string', length= 100)
     */
    private $nom;

    /**
     * @ORM\Column(type= 'string', length= 100)
     */
    private $prenom;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $mail;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $mdp;

    /**
     * @ORM\Column(type: 'boolean')
     */
    private $abonnementNewsletter;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $ville;

    /**
     * @ORM\OneToOne(mappedBy= 'relatedUser', targetEntity= CalendrierDemarches::class, cascade= {'persist', 'remove'})
     */
    private $calendrierDemarches;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getAbonnementNewsletter(): ?bool
    {
        return $this->abonnementNewsletter;
    }

    public function setAbonnementNewsletter(bool $abonnementNewsletter): self
    {
        $this->abonnementNewsletter = $abonnementNewsletter;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCalendrierDemarches(): ?CalendrierDemarches
    {
        return $this->calendrierDemarches;
    }

    public function setCalendrierDemarches(CalendrierDemarches $calendrierDemarches): self
    {
        // set the owning side of the relation if necessary
        if ($calendrierDemarches->getRelatedUser() !== $this) {
            $calendrierDemarches->setRelatedUser($this);
        }

        $this->calendrierDemarches = $calendrierDemarches;

        return $this;
    }
}
