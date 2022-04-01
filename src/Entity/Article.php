<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass= ArticleRepository::class)
 * 
*/
class Article
{
    /** 
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type= "integer")
    */
    private $id;
    
    /**
     * @ORM\Column(type= "string", length= 255)
     */
    private $titre;

    /**
     * @ORM\Column(type= "text")
     */
    private $description;

// /**
//      * NOTE: This is not a mapped field of entity metadata, just a simple property.
//      * 
//      * @Vich\UploadableField(mapping="article", fileNameProperty="imagePath")
//      * 
//      * @var File|null
//      */
//     private $imageFile;

    /**
     * @ORM\Column(type= "string", length= 255, nullable=true)
     */
    private $imagePath;

    /**
     * @ORM\Column(type= "string")
     */
    private $updatedAt;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    // /**
    //  * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
    //  * of 'UploadedFile' is injected into this setter to trigger the update. If this
    //  * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
    //  * must be able to accept an instance of 'File' as the bundle will inject one here
    //  * during Doctrine hydration.
    //  *
    //  * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
    //  */
    // public function setImageFile(?File $imageFile = null): void
    // {
    //     $this->imageFile = $imageFile;

    //     if (null !== $imageFile) {
    //         // It is required that at least one field changes if you are using doctrine
    //         // otherwise the event listeners won't be called and the file is lost
    //         $this->updatedAt = new \DateTimeImmutable();
    //     }
    // }

    // public function getImageFile(): ?File
    // {
    //     return $this->imageFile;
    // }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
