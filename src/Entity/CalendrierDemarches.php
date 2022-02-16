<?php

namespace App\Entity;

use App\Repository\CalendrierDemarchesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendrierDemarchesRepository::class)
 */
class CalendrierDemarches
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDece;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomPrenom;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="calendrierDemarches", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $relatedUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDece(): ?\DateTimeInterface
    {
        return $this->dateDece;
    }

    public function setDateDece(\DateTimeInterface $dateDece): self
    {
        $this->dateDece = $dateDece;

        return $this;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nomPrenom;
    }

    public function setNomPrenom(string $nomPrenom): self
    {
        $this->nomPrenom = $nomPrenom;

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
