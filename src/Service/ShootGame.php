<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 29/03/2019
 * Time: 16:13
 */

namespace App\Service;


use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
class ShootGame{
    private $em;
    private $session;
    private $token;
    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }
    public function shoot(Game $game){
        $rand = rand(0,100);

        if($game instanceof Game){


            if($rand>0 && $rand<51) {
                $this->session->getFlashBag()->add('success', 'DAMMMAAAGEEEE');
                $game->setDamage($game->getDamage() + 100);
            }

            if($rand>50 && $rand<71) {
                $this->session->getFlashBag()->add('success', 'DEEAAAAD');

                $game->setAssassination($game->getAssassination() + 1);
            }
        }
            $this->em->flush();
    }
}