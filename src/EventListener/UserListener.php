<?php

namespace App\EventListener;


use App\Event\ActionEvent;
use App\Event\UserEvent;
use App\Service\Action\ConvertAction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserListener
{
    private $entityManager;
    private $token;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->token = $tokenStorage->getToken();
    }

    public function onUserCreateActive(UserEvent  $event)
    {
        if($event->getUser()->getPlainPassword() !== 'zoumzoum'){
            $event->getUser()->setEnabled(true);
        }
    }

    public function onUserCreate(UserEvent  $event)
    {
        $this->entityManager->persist($event->getUser());
        $this->entityManager->flush();
    }

    public function onUserAction(ActionEvent $event){

        $user = $this->token->getUser();
        $user->setPositionX($user->getPositionX() + ConvertAction::convertDirectionToX($event->getAction()));
        $user->setPositionY($user->getPositionY() + ConvertAction::convertDirectionToY($event->getAction()));

        $this->entityManager->flush();

    }
}