<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Shoot{

    private $weaponUserRepository;

    public function __construct(WeaponUserRepository $weaponUserRepository)
    {
        $this->weaponUserRepository = $weaponUserRepository;
    }

    /**
     * @required
     */
    public function setToken(TokenStorageInterface $token)
    {
        $this->user = $token->getToken()->getUser();
    }

    public function shoot(){

        $weaponUser = $this->weaponUserRepository->getWeaponUserActive($this->user);

        if($weaponUser instanceof WeaponUser){

            if($weaponUser->getAmmunition() > 0) {
                return true;
            }else{
                return false;
            }
        }
        return null;
    }
}

