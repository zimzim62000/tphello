<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 15:58
 */

namespace App\EventSubscriber;


use App\Event\AppEvent;
use App\Event\GameEvent;
use App\Service\CheckUserCharacterDefault;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GameSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $checker;

    public function __construct(EntityManagerInterface $entityManager, CheckUserCharacterDefault $checker){
        $this->entityManager = $entityManager;
        $this->checker = $checker;
    }

    public static function getSubscribedEvents(){

        // TODO: Implement getSubscribedEvents() method.
        return [
            /** UserProduct */
            AppEvent::GameEnd => ['gameEnd', 0],
        ];
    }

    public function gameEnd(GameEvent $event){
        $game = $event->getGame();
        $game->setEndGame(true);

        if($this->checker->defaultCheck()){
            $this->checker->removeDefault();
        }

        $userCharacters = $game->getUserCharacters();
        $userCharacters->setDefaultCharacter(true);

        $this->entityManager->persist($game);
        $this->entityManager->persist($userCharacters);
        $this->entityManager->flush();

    }

}