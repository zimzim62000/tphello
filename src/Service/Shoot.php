<?php


namespace App\Service;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Shoot{

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
        $miss = 50;
        $kill =20;
        if($game instanceof Game){

            if(rand(1,100) <= $miss) {
                $this->session->getFlashBag()->add('success', 'Missed');
            }
            else if (rand(1,100) >= $miss){
                $this->session->getFlashBag()->add('success', '-100 damages');
                $game->setDamage(100);
                $this->em->flush();

            }
            else if (rand(1,100) <= $kill) {
                $game->setAssassination(1);
                $this->em->flush();
            }
        }

    }
}

