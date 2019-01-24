<?php

namespace App\Tests\Service\WeaponUser;

use App\Entity\User;
use App\Entity\Weapon;
use App\Repository\WeaponUserRepository;
use App\Service\WeaponUser\CanShoot;
use App\Service\WeaponUser\LoadWeapon;
use App\Service\WeaponUser\Shoot;
use App\Service\WeaponUser\ShootUser;
use PHPUnit\Framework\TestCase;

use App\Entity\WeaponUser;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class ShootUserTest extends TestCase{

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

        $shoot = new CanShoot($repo);
        $shoot->setToken($token);

        return $shoot;
    }

    public function testShootUserCanShootNull(){
        $token = $this->createMock(TokenStorage::class);
        $canShoot = $this->createMock(CanShoot::class);

        $canShoot->expects($this->once())
            ->method('canShoot')
            ->willReturn(null);
        $shoot = $this->createMock(Shoot::class);

        $flashBag = $this->createMock(FlashBag::class);
        $session = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('getFlashBag')
            ->willReturn($flashBag);
        $flashBag->expects($this->once())
            ->method('add');

        $shootUser = new ShootUser($token, $canShoot, $shoot, $session);

        $shootUser->shootUser(null);
    }


    public function testShootUserCanShootMagrandMere(){
        $token = $this->createMock(TokenStorage::class);
        $canShoot = $this->createMock(CanShoot::class);

        $canShoot->expects($this->once())
            ->method('canShoot')
            ->willReturn('magrandmere');
        $shoot = $this->createMock(Shoot::class);

        //$flashBag = $this->createMock(FlashBag::class);
        $session = $this->createMock(Session::class);
        /*$session->expects($this->once())
            ->method('getFlashBag')
            ->willReturn($flashBag);
        $flashBag->expects($this->once())
            ->method('add');
*/
        $shootUser = new ShootUser($token, $canShoot, $shoot, $session);

        $shootUser->shootUser(null);
    }

}