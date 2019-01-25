<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParierController extends AbstractController
{
    /**
     * @Route("/parier/{id}", name="parier_match", methods="GET")
     */
    public function parier(Game $game): Response
    {
        return $this->render('home/match_show.html.twig', ['game' => $game]);
    }
}
