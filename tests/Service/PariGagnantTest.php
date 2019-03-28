<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 08/02/2019
 * Time: 08:30
 */

namespace App\tests\Service;


use App\Service\GainPotentielManager;
use App\Service\PariGagnantManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\Tests\TestCase;
use App\Entity\Bet;
use App\Entity\Game;

use App\Repository\GameRepository;
use App\Repository\BetRepository;

class PariGagnantTest extends TestCase{




    private function betPerfect(){
        $bet = new Bet();
        $game = new Game();

        $pariGagnant = $this->createMock(PariGagnantManager::class);
        $pariGagnant->expects($this->once())
            ->method('win')
            ->willReturn(GainPotentielManager::SCORE_EXACT);


        $bet->setScoreTeamA(6);
        $bet->setScoreTeamB(6);
        $bet->setAmout(1);

        $game->setScoreTeamA(6);
        $game->setScoreTeamB(6);

        $game->setRating(1);


        $pari = new GainPotentielManager($pariGagnant);

        $this->assertEquals(3, $pari -> Win($bet));

    }

    private function betBon(){
        $bet = new Bet();
        $game = new Game();

        $pariGagnant = $this->createMock(PariGagnantManager::class);
        $pariGagnant->expects($this->once())
            ->method('win')
            ->willReturn(GainPotentielManager::BONNE_ISSUE);


        $bet->setScoreTeamA(7);
        $bet->setScoreTeamB(6);


        $game->setScoreTeamA(6);
        $game->setScoreTeamB(6);
        $bet->setAmout(1);

        $game->setRating(1);


        $pari = new GainPotentielManager($pariGagnant);

        $this->assertEquals(1, $pari -> Win($bet));

    }

}

