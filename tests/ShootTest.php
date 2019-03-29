<?php

namespace App\Tests;

use App\Entity\Game;
use App\Service\ShootService;
use PHPUnit\Framework\TestCase;

class ShootTest extends TestCase
{

    public function testKill()
    {
        $game = new Game();
        $game->setAssassination(0)
            ->setDamage(1500)
            ->setEndGame(false)
            ->setPosition(0)
            ->setReanimation(0)
            ->setCreatedAt(new \DateTime());

        $shootService = new ShootService();
        $shootService->shoot($game, $game, [1, 1]); // il se kill lui meme hehe

        $this->assertTrue($game->getEndGame());
    }

    public function testDMG()
    {
        $game = new Game();
        $game->setAssassination(0)
            ->setDamage(1500)
            ->setEndGame(false)
            ->setPosition(0)
            ->setReanimation(0)
            ->setCreatedAt(new \DateTime());

        $shootService = new ShootService();
        $shootService->shoot($game, $game, null, [1, 1]); // il se kill lui meme hehe

        $this->assertEquals(1400, $game->getDamage());
    }

    /**
     * @expectedException TypeError
     */
    public function testPasDeParams()
    {
        $shootService = new ShootService();
        $shootService->shoot();
    }
}
