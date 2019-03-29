<?php

namespace App\EventListener;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

class GameListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onDeleteAllGames()
    {
        $games = $this->entityManager->getRepository(Game::class)->findAll();

        foreach($games as $game)
        {
            $this->entityManager->remove($game);

        }
        $this->entityManager->flush();
    }

}