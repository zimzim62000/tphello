<?php

namespace App\Tests\Service\WeaponUser;

use App\Entity\User;
use App\Entity\Weapon;
use App\Repository\WeaponUserRepository;
use App\Service\WeaponUser\CanShoot;
use App\Service\WeaponUser\LoadWeapon;
use App\Service\WeaponUser\ShootUser;
use App\Service\WeaponUser\Shoot;
use PHPUnit\Framework\TestCase;

use App\Entity\WeaponUser;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class ShootUserTest extends TestCase{

    private function initShoot($shoot){

        $canShoot = $this->createMock(CanShoot::class);
        $canShoot->expects($this->once())
            ->method('canShoot')
            ->willReturn($shoot);

        $user = $this->createMock(User::class);
        $tokenToken = $this->createMock(PostAuthenticationGuardToken::class);
        $flashBag = $this->createMock(FlashBag::class);
        $session = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('getFlashBag')
            ->willReturn($flashBag);
        $flashBag->expects($this->once())
            ->method('add');

        $shoot = $this->createMock(Shoot::class);
        $shoot->expects($this->once())
            ->method('shoot')
            ->willReturn($user);

        $shootUser = new ShootUser($tokenToken,$canShoot,$shoot,$session);
        

        return $shootUser;
    }

    public function testShootWithoutUserNull(){
        $shoot = $this->initShoot(null);
        $this->assertEquals(null, $shoot->shootUser());
    }

    public function testShootWithoutUserTrue(){
        $shoot = $this->initShoot(true);
        $this->assertEquals(true, $shoot->shootUser());
    }

    public function testShootWithoutUserFalse(){
        $shoot = $this->initShoot(false);
        $this->assertEquals(false, $shoot->shootUser());
    }
}