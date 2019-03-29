<?php
/**
 * Created by PhpStorm.
 * User: amaury.beauchamp
 * Date: 29/03/19
 * Time: 16:40
 */

namespace App\Tests\Service;

use App\Entity\Game;
use App\Service\Shoot;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

class ShootTest extends TestCase
{
    public function initShoot($repoData)
    {
        $repo = $this->createMock(ServiceEntityRepository::class);
        $repo->expects($this->once())
            ->method('findBy')
            ->willReturn($repoData);
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($repo);
        $em->expects($this->once())
            ->method('flush');
        $session = $this->createMock(Session::class);

        $tokenToken = $this->createMock(PostAuthenticationGuardToken::class);
        $token = $this->createMock(TokenStorage::class);
        $token->expects($this->once())
            ->method('getToken')
            ->willReturn($tokenToken);
        return new Shoot($em, $session, $token);
    }

    public function testShoot() {
        $game = new Game();

        $game->setAssassination(0)
            ->setEndGame(false)
            ->setReanimation(0)
            ->setDamage(1000)
            ->setCreatedAt(new \DateTime())
            ->setPosition(0);

        $shoot = $this->initShoot($game);

        $shoot->shoot($game);

        $this->assertEquals(1, $game->getAssassination());
    }

    public function testDamage() {
        $game = new Game();

        $game->setAssassination(0)
            ->setEndGame(false)
            ->setReanimation(0)
            ->setDamage(1000)
            ->setCreatedAt(new \DateTime())
            ->setPosition(0);

        $shoot = $this->initShoot($game);

        $shoot->shoot($game);

        $this->assertEquals(1100, $game->getDamage());
    }





}