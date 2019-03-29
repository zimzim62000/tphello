<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 15:50
 */

namespace App\Service;


use App\Entity\UserCharacters;
use App\Repository\UserCharactersRepository;

class UserCharacterService
{
    private $userCharactersRepository;

    public function __construct(UserCharactersRepository $userCharactersRepository)
    {
        $this->userCharactersRepository = $userCharactersRepository;
    }


    public function validate(UserCharacters $userCharacters){

        $result = $this->userCharactersRepository->findBy(['user'=>$userCharacters->getUser(),'character'=>$userCharacters->getCharacters()]);

        if(count($result) === 0){
            return true;
        }
        else return false;


    }
}