<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 29/03/2019
 * Time: 16:40
 */

namespace App\Tests\Service;


use App\Entity\Game;
use App\Repository\GameRepository;
use App\Service\ShootGame;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class GameTest extends TestCase
{
//RIEN Un string valeur limite

    public function initShoot(){
      $game = new Game();
      $game->setAssassination(0);
      $game->setDamage(0);
      $game->setEndGame(0);
      $game->setReanimation(0);
      $game->setPosition(0);


        $session = $this->createMock(SessionInterface::class);
        $session->expects($this->once())
            ->method('getSession')
            ->willReturn($session);


        $em=$this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getManager')
            ->willReturn($em);

        $shoot = new ShootGame($game,$session,$em);

        return $shoot;
    }


    public function testShootWithoutLimite(){
        $game = $this->initShoot();



        //$this->assertEquals(0, $shoot->ShootGame());

    }

    public function testShootInString()
    {

    }


}