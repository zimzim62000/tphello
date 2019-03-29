<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 15:00
 */

namespace App\Service;

use App\Entity\Game;
use App\Entity\UserCharacters;
use App\Repository\UserCharactersRepository;

class endGameService
{
    private $userCharactersRepository;

    public function __construct(UserCharactersRepository $userCharactersRepository)
    {
        $this->userCharactersRepository = $userCharactersRepository;
    }

    private function verifyGame(){

        $userCharacters = $this->userCharactersRepository->findByActive();
        if(count($userCharacters) !== 0){
            return false;
        }
        else return true;
    }

    public function endGame(Game $game){

        if($this->verifyGame()){
            $game->setEndGame(true);
            $game->getUserCharacters()->setDefaultCharacter(true);
        }
    }


}