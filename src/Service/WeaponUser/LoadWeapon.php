<?php

namespace App\Service\WeaponUser;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\WeaponUser;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LoadWeapon
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

    public function load(WeaponUser $weaponUser)
    {

        $weaponsUser = $this->em->getRepository(WeaponUser::class)->findBy(['user' => $this->token->getToken()->getUser()]);
        array_map(function ($obj) {
            $obj->setActive(false);
        }, $weaponsUser);
        $weaponUser->setActive(true);
        $this->session->getFlashBag()->add('success', $weaponUser->getWeapon()->getName() . ' is loaded ! beware of the bang bang');
        $this->em->flush();
    }
}

