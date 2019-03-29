<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 15:55
 */

namespace App\Event;


use App\Entity\Game;
use Symfony\Component\EventDispatcher\Event;

class GameEvent extends Event
{

    private $game;


    public function getGame(): Game
    {
        return $this->game;
    }


    public function setGame(Game $game)
    {
        $this->game = $game;
    }

}