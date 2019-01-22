<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Process\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Shoot{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    private $weaponUser;

    public function setWeaponUser($weaponUser)
    {
        $this->weaponUser = $weaponUser;
    }


    public function shoot(User $user = null){

        if(!$this->weaponUser instanceof WeaponUser) {
            throw new InvalidArgumentException('WeaponUser must be set');
        }

        $this->weaponUser->setAmmunition($this->weaponUser->getAmmunition()-1);

        if($user !== null){
            $user->setHealth($user->getHealth()-($this->weaponUser->getQuality()*$this->weaponUser->getWeapon()->getDamage()));
        }
        $this->em->flush();
    }
}
