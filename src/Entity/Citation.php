<?php

namespace App\Entity;

use App\Repository\CitationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitationRepository::class)]
class Citation
{
    /** 
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type= "integer")
    */
    private $id;

    /**
     * @ORM\Column(type= "text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
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
}
