<?php
namespace App\Service;

use App\Entity\Bet;

class CalculPtsPariService{
    private const PERFECT_RESULT = 3;
    private const CORRECT_RESULT = 1;

//Créer un service qui calcule les gains potentiels de l'utilisateur sur chaque match
//  Si l'utilisateur à la bonne issue du match ratio de 1
//  Si l'utilisateur à le score exacte le ratio est de 3
//  Calcul Gain: Amount * Rating * ratio

    public function potentialWin(Bet $bet){
        $match = $bet->getGame();
        if($match->getScoreTeamA() === $bet->getScoreTeamA() &&
        $match->getScoreTeamB() === $bet->getScoreTeamB())
        {
            //le perfect
            return $bet->getAmout() * $match->getRating() * self::PERFECT_RESULT;
        }
        if($match->getScoreTeamA() > 6 && $bet->getScoreTeamA() > 6)
        {
            //team A qui win,
            return $bet->getAmout() * $match->getRating() * self::CORRECT_RESULT;
        }

        if($match->getScoreTeamB() > 6 && $bet->getScoreTeamB() > 6)
        {
            //team A qui win,
            return $bet->getAmout() * $match->getRating() * self::CORRECT_RESULT;
        }

        // sinon il a perdu, il perd sa mise
        return $bet->getAmout() * -1;

    }
}