<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 07/02/2019
 * Time: 12:13
 */


namespace App\Service;

use App\Entity\Bet;
use App\Service\PariGagnantManager;

class GainPotentielManager
{

    public $pariGagnantManager;

    public function __construct(PariGagnantManager $pariGagnantManager){
        $this->pariGagnantManager = $pariGagnantManager;

    }


    public function Win(Bet $bet)
    {


        $match = $bet->getGame();

        $win =  $this->pariGagnantManager->Win($bet);

        if ($win == -1) {
            return $win * $bet->getAmout();
        }
        return $win * $match->getRating() * $bet->getAmout();


    }


}

