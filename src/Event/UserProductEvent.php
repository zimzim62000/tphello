<?php

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserProductEvent extends Event{

    private $userproduct;

    /**
     * @return mixed
     */
    public function getUserproduct()
    {
        return $this->userproduct;
    }

    /**
     * @param mixed $userproduct
     */
    public function setUserproduct($userproduct)
    {
        $this->userproduct = $userproduct;
    }

}