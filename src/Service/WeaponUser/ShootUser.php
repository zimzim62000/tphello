<?php

namespace App\Service\WeaponUser;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ShootUser
{

    private $token;
    private $canShoot;
    private $shoot;
    private $session;

    public function __construct(TokenStorageInterface $token, CanShoot $canShoot, Shoot $shoot, SessionInterface $session)
    {
        $this->token = $token;
        $this->canShoot = $canShoot;
        $this->shoot = $shoot;
        $this->session = $session;
    }

    public function shootUser(User $user = null)
    {
        $canShoot = $this->canShoot->canShoot($user);

        if ($canShoot === true) {
            $this->session->getFlashBag()->add('success', 'Bang Bang');
            $this->shoot->setWeaponUser($this->canShoot->getWeaponUser());
            $this->shoot->shoot($user);
        }
        if ($canShoot === false) {
            $this->session->getFlashBag()->add('error', 'Oh, I\'m out of ammo, need reload');
        }
        if ($canShoot === null) {
            $this->session->getFlashBag()->add('error', 'No Weapon Load :/');
        }
    }
}

