<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualityRepository")
 * @UniqueEntity(fields={"title"}, message="There is already an article with this title")
 * @Vich\Uploadable()
 */
class Actuality
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="actuality_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="100")
     */
    private $content;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min="10")
     */
    private $resume;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $dateParution;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct()
    {
        $this->dateParution = new DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Actuality
     */
    public function setFilename(?string $filename): Actuality
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function setImageFile(?File $imageFile): Actuality
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResume(): ?string
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     * @return Actuality
     */
    public function setResume(string $resume): Actuality
    {
        $this->resume = $resume;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateParution(): DateTime
    {
        return $this->dateParution;
    }

    /**
     * @param DateTime $dateParution
     * @return Actuality
     */
    public function setDateParution(DateTime $dateParution): Actuality
    {
        $this->dateParution = $dateParution;
        return $this;
    }


}
