<?php

namespace App\Service\WeaponUser;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\WeaponUser;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReloadWeapon{

    private $em;
    private $session;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function reload(WeaponUser $weaponUser){
        $this->session->getFlashBag()->add('success', 'Crick Crick');
        $weaponUser->setAmmunition(WeaponUser::MAX_AMMU);
        $this->em->flush();
    }
}

