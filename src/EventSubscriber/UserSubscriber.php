<?php
namespace App\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function onUserProductAdd($event)
    {
        $game = $event->getGame();
        $usercharacter = $event->getUserCharacter();

        $game->setEndGame(true);
        $usercharacter->setDefaultCharacter(true);

        $this->entityManager->persist($game);
        $this->entityManager->persist($usercharacter);
        $this->entityManager->flush();
    }
    public static function getSubscribedEvents()
    {
        return [
            'app.game.end' => 'onEndGame',
        ];
    }
}