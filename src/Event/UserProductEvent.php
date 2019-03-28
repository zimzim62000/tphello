<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 10:40
 */

namespace App\Event;

use App\Entity\UserProduct;
use Symfony\Component\EventDispatcher\Event;

class UserProductEvent extends Event
{
    private $userProduct;

    public function getUserProduct(){
        return $this->userProduct;
    }

    public function setUserProduct(UserProduct $userProduct){
        $this->userProduct = $userProduct;
    }
}