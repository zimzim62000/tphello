<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 16:06
 */

namespace App\Service;


use App\Entity\Characters;
use App\Repository\CharactersRepository;

class CharactersService
{
    private $charactersRepository;

    public function __construct(CharactersRepository $charactersRepository)
    {
        $this->charactersRepository = $charactersRepository;
    }

    public function verifyNameInDatabase(Characters $characters){

        $result = $this->charactersRepository->findBy(['name' => $characters->getName()]);

        if(count($result) === 0){
            return true;
        }
        else{
            return false;
        }
    }

}