<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomContraints;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharactersRepository")
 */
class Characters
{
    const UPLOAD_DIRECTORY = '/img/Characters';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $name;//@CustomContraints\SameNameCharacter

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * * @Assert\File(mimeTypes={"image/png", "image/jpeg", "image/gif"})
     */
    private $photo;

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

    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo): self
    {
        $this->photo = $photo;
        return $this;
    }
    
    public function __toString()
    {
        return $this->getRole()->getName() .' : ' .$this->name;
    }
}
