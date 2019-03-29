<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCharactersRepository")
 */
class UserCharacters
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**<th>Id</th>
                <th>Name</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        {% for character in characters %}
            <tr>
                <td>{{ character.id }}</td>
                <td>{{ character.name }}</td>
                <td>
                    <a href="{{ path('characters_show', {'id': character.id}) }}">show</a>
                    <a href="{{ path('characters_edit', {'id': character.id}) }}">edit</a>
                </td>
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $favorite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $defaultCharacter;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Characters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characters;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }

    public function getDefaultCharacter(): ?bool
    {
        return $this->defaultCharacter;
    }

    public function setDefaultCharacter(bool $defaultCharacter): self
    {
        $this->defaultCharacter = $defaultCharacter;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCharacters(): ?Characters
    {
        return $this->characters;
    }

    public function setCharacters(?Characters $characters): self
    {
        $this->characters = $characters;

        return $this;
    }

    public function __toString()
    {
        return $this->user->getUsername().' - '.$this->characters;
    }
}
