<?php
/**
 * Created by PhpStorm.
 * User: amaury.beauchamp
 * Date: 29/03/19
 * Time: 16:17
 */

namespace App\Service;


use App\Entity\Game;
use App\Entity\User;
use App\Entity\UserCharacters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Shoot
{
    private $em;
    private $session;
    private $token;
    public function __construct(EntityManagerInterface $em, SessionInterface $session, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->session = $session;
        $this->token = $token;
    }
    public function shoot(Game $game){

        $rand = rand(1, 100);

        if ( $rand <= 20) {
            $game->setAssassination($game->getAssassination()+1);
        }

        if ($rand <= 50) {
            $game->setDamage($game->getDamage()+100);
        }

        $this->em->flush();
    }
}