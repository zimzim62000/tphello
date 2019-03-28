<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="integer")
     */
    private $assassination;

    /**
     * @ORM\Column(type="integer")
     */
    private $reanimation;

    /**
     * @ORM\Column(type="integer")
     */
    private $damage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCharacters;

    /**
     * @ORM\Column(type="boolean")
     */
    private $endGame;

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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getAssassination(): ?int
    {
        return $this->assassination;
    }

    public function setAssassination(int $assassination): self
    {
        $this->assassination = $assassination;

        return $this;
    }

    public function getReanimation(): ?int
    {
        return $this->reanimation;
    }

    public function setReanimation(int $reanimation): self
    {
        $this->reanimation = $reanimation;

        return $this;
    }

    public function getUserCharacters(): ?UserCharacters
    {
        return $this->userCharacters;
    }

    public function setUserCharacters(?UserCharacters $userCharacters): self
    {
        $this->userCharacters = $userCharacters;

        return $this;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getEndGame(): ?bool
    {
        return $this->endGame;
    }

    public function setEndGame(bool $endGame): self
    {
        $this->endGame = $endGame;

        return $this;
    }
}
