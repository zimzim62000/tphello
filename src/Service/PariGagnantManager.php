<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 07/02/2019
 * Time: 12:36
 */

namespace App\Service;

use App\Entity\Bet;

class PariGagnantManager
{
    CONST SCORE_EXACT = 3;
    CONST BONNE_ISSUE = 1;

    public function Win(Bet $bet)
    {


        $match = $bet->getGame();
        if ($match->getScoreTeamA() === $bet->getScoreTeamA() &&
            $match->getScoreTeamB() === $bet->getScoreTeamB()) {
            //le perfect
            return self::SCORE_EXACT;
        }
        if ($match->getScoreTeamA() > 6 && $bet->getScoreTeamA() > 6) {
            //team A qui win,
            return self::BONNE_ISSUE;
        }
        if ($match->getScoreTeamB() > 6 && $bet->getScoreTeamB() > 6) {
            //team B qui win,
            return self::BONNE_ISSUE;
        }
        //PERDU
        return $bet->getAmout() * -1;


    }
}