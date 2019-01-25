<?php

namespace App\Controller;


use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/matchs", name="match_index", methods="GET")
     */
    public function matchs(GameRepository $gameRepository): Response
    {
        return $this->render('home/matchs.html.twig', ['games' => $gameRepository->findAll()]);
    }

    /**
     * @Route("/match/{id}", name="voir_match", methods="GET")
     */
    public function match(Game $game): Response
    {
        return $this->render('home/match_show.html.twig', ['game' => $game]);
    }

}
