<?php

namespace App\EventSubscriber;

use App\Event\AppEvent;
use App\Event\UserEvent;
use App\Event\UserProductEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\EventDispatcher\Event;

class UserProductSubscriber implements EventSubscriberInterface{

    private $encoder;
    private $entityManager;
    private $token;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
        $this->token = $tokenStorage->getToken();
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::UserProductSave => ['userProductPersist'] //celui le plus haut repond avant le plus bas

        ];
    }


    public function userProductPersist(UserProductEvent $event){
        $UserProduct = $event->getUserProduct();
        $produit = $UserProduct->getProduct();
        $produit->setQuantity($produit->getQuantity() -
            $UserProduct->getQuantity()
        );
        $this->entityManager->persist($produit);

        $this->entityManager->persist($UserProduct);
        $this->entityManager->flush();
    }


}