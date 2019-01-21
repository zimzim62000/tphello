<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ShootWeapon{

    private $em;
    private $session;
    private $token;

    public function __construct(EntityManagerInterface $em, SessionInterface $session, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->session = $session;
        $this->token = $token;
    }

    public function shoot(User $user){

        $weaponUser = $this->em->getRepository(WeaponUser::class)->findOneBy(['user' => $this->token->getToken()->getUser(), 'active' => true]);

        if($weaponUser instanceof WeaponUser){

            $this->session->getFlashBag()->add('success', 'Bang Bang');

            $user->setHealth($user->getHealth()-($weaponUser->getQuality()*$weaponUser->getWeapon()->getDamage()));
            $weaponUser->setAmmunition($weaponUser->getAmmunition() - 1);

            $this->em->flush();
        }
    }
}

