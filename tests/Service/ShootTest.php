<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 15:19
 */

namespace App\Tests\Service;


use App\Entity\Game;
use App\Service\LetsShoot;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\Exception;

class ShootTest extends TestCase
{
    public function maGame(){
        $game = new Game();
        $game->setDamage(0);
        $game->setAssassination(0);

        return $game;
    }

    public function testKill()
    {
        $game = $this->maGame();

        $testShoot = new LetsShoot();
        $game = $testShoot->shoot($game, 2);

        $this->assertEquals($game->getAssassination(), 1);
        $this->assertEquals($game->getDamage(), 100);
    }

    public function testHit()
    {
        $game = $this->maGame();
        $testShoot = new LetsShoot();
        $game = $testShoot->shoot($game, 5);

        $this->assertEquals($game->getAssassination(), 0);
        $this->assertEquals($game->getDamage(), 100);
    }

    public function testRater()
    {
        $game = $this->maGame();
        $testShoot = new LetsShoot();
        $game = $testShoot->shoot($game, 9);

        $this->assertEquals($game->getAssassination(), 0);
        $this->assertEquals($game->getDamage(), 0);
    }

    public function testBadParams()
    {
        $game = $this->maGame();
        $testShoot = new LetsShoot();
        $game = $testShoot->shoot($game, "ma grand-mere");

        $this->assertEquals($game->getAssassination(), 0);
        $this->assertEquals($game->getDamage(), 0);
    }

    public function testNoParams()
    {
        $testShoot = new LetsShoot();

        try{
            $game = $testShoot->shoot("ma grand-mere");
        }catch(Exception $e){
            $this->assertEquals($e->getMessage(), "Parametre non Game");
        }
    }


}