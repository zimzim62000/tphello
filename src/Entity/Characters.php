<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharactersRepository")
 * @UniqueEntity("name")
 */
class Characters
{
    const DIR_UPLOAD = 'character';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;


    /**
     *
     * @Assert\File(mimeTypes={"image/png", "image/jpeg", "image/gif"})
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     */
    private $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    public function setPictureFile($pictureFile): self
    {
        $this->pictureFile = $pictureFile;
        return $this;
    }
    public function getPathPicture(): string
    {
        return self::DIR_UPLOAD . '/' . $this->getPicture();
    }

    public function __toString()
    {
        return $this->getRole()->getName() .' : ' .$this->name;
    }
}
