<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class EndGameEvent extends Event{

    /**@var \App\Entity\Game
     */
    private $game;

    /**
     * @return \App\Entity\Game
     */
    public function getGame(): \App\Entity\Game
    {
        return $this->game;
    }

    /**
     * @param \App\Entity\Game $game
     */
    public function setGame(\App\Entity\Game $game): void
    {
        $this->game = $game;
    }


}