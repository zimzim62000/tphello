<?php

namespace App\Service\Game;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

class ShootWeapon
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function shoot(Game $game)
    {
        $rand = rand(1,10);
       if($rand <=2) {
           $game->setAssassination($game->getAssassination()+1);
       }
       if ($rand<= 10) {
           $game->setDamage($game->getDamage() + 100);
       }
        $this->em->flush();
    }
}