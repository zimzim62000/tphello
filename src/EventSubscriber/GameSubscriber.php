<?php

namespace App\EventSubscriber;

use App\Entity\Game;
use App\Entity\UserCharacters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GameSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onGameEndGame($event)
    {
        $game = $event->getGame();
        $game->setEndGame(true); //fin dla game
        $user = $game->getUserCharacters()->getUser();
        $userChars = $this->entityManager->getRepository(UserCharacters::class)->findBy(['user' => $user]);
        foreach($userChars as $uchar)
        {
            //on les met tous a false
            $uchar->setDefaultCharacter(false);
        }
        $game->getUserCharacters()->setDefaultCharacter(true); //sauf celui la
        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
           'game.endGame' => 'onGameEndGame',
        ];
    }
}
