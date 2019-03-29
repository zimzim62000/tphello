<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 14:23
 */

namespace App\Service;


use App\Entity\Game;
use App\Entity\UserCharacters;

class ShootService
{
    /*
     * Cette fonction renvoie 0 pour raté, 1 pour touché et 2 pour mort
     */
    function Shoot() {

        $chance = rand(0,99);

        if($chance < 20){
            return 2;
        }
        if($chance < 70){
            return 1;
        }
        return 0;


    }
}