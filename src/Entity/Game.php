<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AnthoAssert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @AnthoAssert\DifferentTeam
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
     * @ORM\ManyToOne(targetEntity="Team")
     * @Assert\NotIdenticalTo(
     *     value = teamB
     * )
     */
    private $teamA;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $teamB;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(
     *      min = 0,
     *      max = 12,
     *      minMessage = "The score must be between {{ limit }}",
     *      maxMessage = "The score must be between {{ limit }}",
     * )
     */
    private $scoreTeamA;

    /**
     * @ORM\Column(type="integer", nullable=true)
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
     * @ORM\Column(type="decimal", precision=5, scale=3, nullable=true)
     */
    private $rating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamA(): ?Team
    {
        return $this->teamA;
    }

    public function setTeamA(Team $teamA): self
    {
        $this->teamA = $teamA;

        return $this;
    }

    public function getTeamB(): ?Team
    {
        return $this->teamB;
    }

    public function setTeamB(Team $teamB): self
    {
        $this->teamB = $teamB;

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

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
