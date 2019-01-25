<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BetRepository")
 */
class Bet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Game")
     */
    private $game;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 12,
     *      minMessage = "The score must be between {{ limit }}",
     *      maxMessage = "The score must be between {{ limit }}",
     * )
     */
    private $scoreTeamA;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 12,
     *      minMessage = "The score must be between {{ limit }}",
     *      maxMessage = "The score must be between {{ limit }}",
     * )
     */
    private $scoreTeamB;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $amout;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getScoreTeamA(): ?int
    {
        return $this->scoreTeamA;
    }

    public function setScoreTeamA(int $scoreTeamA): self
    {
        $this->scoreTeamA = $scoreTeamA;

        return $this;
    }

    public function getScoreTeamB(): ?int
    {
        return $this->scoreTeamB;
    }

    public function setScoreTeamB(int $scoreTeamB): self
    {
        $this->scoreTeamB = $scoreTeamB;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAmout()
    {
        return $this->amout;
    }

    public function setAmout($amout): self
    {
        $this->amout = $amout;

        return $this;
    }
}
