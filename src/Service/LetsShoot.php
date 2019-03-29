<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 14:58
 */

namespace App\Service;


use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Runner\Exception;

class LetsShoot
{
    public function shoot($game, $maChance = null){
        if(!$game instanceof Game){
            throw new Exception("Parametre non Game");
        }
        switch ($maChance){
            case 1:
            case 2:
                $game->setAssassination($game->getAssassination() + 1);
                $game->setDamage($game->getDamage() + 100);
                break;
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
                $game->setDamage($game->getDamage() + 100);
                break;
            default:
                break;
        }

        return $game;
    }
}