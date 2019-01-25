<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user_game")
 */
class GameUserController extends AbstractController
{
    /**
     * @Route("/", name="user_game_index", methods="GET")
     */
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/match.html.twig', ['games' => $gameRepository->findAll()]);
    }


    /**
     * @Route("/{id}", name="user_game_show", methods="GET")
     */
    public function show(Game $game): Response
    {
        return $this->render('game/show_match.html.twig', ['game' => $game]);
    }

}
