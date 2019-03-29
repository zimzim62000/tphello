<?php

namespace App\Event;

use App\Entity\Game;
use App\Form\GameType;
use Symfony\Component\EventDispatcher\Event;

class GameEvent extends Event{

    /**@var \App\Entity\Game
     */
    private $game;


    public function getGame() : Game
    {
        return $this->game;
    }

    public function setGame(Game $game)
    {
        $this->game = $game;
    }







}