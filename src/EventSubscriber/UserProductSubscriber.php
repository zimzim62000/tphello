<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 10:43
 */

namespace App\EventSubscriber;


use App\Event\AppEvent;
use App\Event\UserProductEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserProductSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(){

        // TODO: Implement getSubscribedEvents() method.
        return [
            /** UserProduct */
            AppEvent::UserProductCreate => ['userProductCreate', 0],
        ];
    }

    public function userProductCreate(UserProductEvent $event){
        $userProduct = $event->getUserProduct();
        $produit = $userProduct->getProduct();
        $produit->setQuantity($produit->getQuantity() - $userProduct->getQuantity());

        $this->entityManager->persist($produit);
        $this->entityManager->persist($userProduct);
        $this->entityManager->flush();

    }
}