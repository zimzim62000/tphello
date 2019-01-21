<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ShootUser{

    private $token;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    public function shoot(User $user = null){

    }
}

