<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 28/03/2019
 * Time: 11:19
 */

namespace App\Event;


use App\Entity\UserProduct;


class UserProductEvent extends \Symfony\Component\EventDispatcher\Event
{
    /**@var \App\Entity\UserProduct
     */
    private $userProduct;

    /**
     * @return \App\Entity\UserProduct
     */
    public function getUserProduct(): UserProduct
    {
        return $this->userProduct;
    }

    /**
     * @param \App\Entity\UserProduct $userProduct
     */
    public function setUserProduct(UserProduct $userProduct)
    {
        $this->userProduct = $userProduct;
    }

}