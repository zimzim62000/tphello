<?php

namespace App\Tests\Service\WeaponUser;

use App\Entity\User;
use App\Entity\Weapon;
use App\Repository\WeaponUserRepository;
use App\Service\WeaponUser\LoadWeapon;
use App\Service\WeaponUser\Shoot;
use PHPUnit\Framework\TestCase;

use App\Entity\WeaponUser;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class ShootTest extends TestCase{

    private function initShoot($weaponUser){

        $repo = $this->createMock(WeaponUserRepository::class);
        $repo->expects($this->once())
            ->method('getWeaponUserActive')
            ->willReturn($weaponUser);

        $user = $this->createMock(User::class);

        $tokenToken = $this->createMock(PostAuthenticationGuardToken::class);
        $tokenToken->expects($this->once())
            ->method('getUser')
            ->willReturn($user);

        $token = $this->createMock(TokenStorage::class);
        $token->expects($this->once())
            ->method('getToken')
            ->willReturn($tokenToken);

        $shoot = new Shoot($repo);
        $shoot->setToken($token);

        return $shoot;
    }

    public function testShootWithoutUserWithoutWeaponUser(){

        $shoot = $this->initShoot(null);

        $this->assertEquals(null, $shoot->shoot());
    }

    public function testShootWithoutUserWithoutAmunition(){

        $weaponUser = new WeaponUser();
        $weaponUser->setAmmunition(0);

        $shoot = $this->initShoot($weaponUser);

        $this->assertFalse($shoot->shoot());
    }

    public function testShootWithoutUserWithAmunition(){

        $weaponUser = new WeaponUser();
        $weaponUser->setAmmunition(10);

        $shoot = $this->initShoot($weaponUser);

        $this->assertTrue($shoot->shoot());
    }
}