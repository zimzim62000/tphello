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

class LetsShoot
{
    private $em;
    public function __construct(EntityManagerInterface $entityManager){
        $this->em = $entityManager;
    }

    public function shoot(Game $game){
        $maChance = rand(1, 10);
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

        $this->em->persist($game);
        $this->em->flush();
    }
}