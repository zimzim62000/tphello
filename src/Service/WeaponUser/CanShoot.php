<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CanShoot{

    private $weaponUserRepository;
    private $weaponUser;

    public function __construct(WeaponUserRepository $weaponUserRepository)
    {
        $this->weaponUserRepository = $weaponUserRepository;
    }

    /**
     * @return WeaponUser
     */
    public function getWeaponUser()
    {
        return $this->weaponUser;
    }

    /**
     * @required
     */
    public function setToken(TokenStorageInterface $token)
    {
        $this->user = $token->getToken()->getUser();
    }

    public function canShoot(){

        $this->weaponUser = $this->weaponUserRepository->getWeaponUserActive($this->user);

        if($this->weaponUser instanceof WeaponUser){
            if($this->weaponUser->getAmmunition() > 0) {
                return true;
            }else{
                return false;
            }
        }
        return null;
    }
}
