<?php

namespace App\Event;

use App\Entity\UserCharacters;
use Symfony\Component\EventDispatcher\Event;

class UserCharacterEvent extends Event{

    /**@var \App\Entity\UserCharacters
     */
    private $usercharacter;

    /**
     * @return mixed
     */
    public function getUsercharacter()
    {
        return $this->usercharacter;
    }

    /**
     * @param mixed $usercharacter
     */
    public function setUsercharacter($usercharacter)
    {
        $this->usercharacter = $usercharacter;
    }




}