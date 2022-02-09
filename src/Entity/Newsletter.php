<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    /** 
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type= 'integer')
    */
    private $id;

    /**
     * @ORM\Column(type= 'integer')
     */
    private $numeroNews;

    /**
     * @ORM\Column(type= 'string', length= 255)
     */
    private $titre;

    /**
     * @ORM\Column(type= 'text')
     */
    private $description;

    /**
     * @ORM\Column(type= 'datetime_immutable')
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroNews(): ?int
    {
        return $this->numeroNews;
    }

    public function setNumeroNews(int $numeroNews): self
    {
        $this->numeroNews = $numeroNews;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
