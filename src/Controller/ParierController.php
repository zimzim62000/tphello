<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Entity\Game;
use App\Form\BetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParierController extends AbstractController
{
    /**
     * @Route("/parier/{id}", name="parier_match", methods="GET")
     */
    public function parier(Game $game, Request $request): Response
    {
        $bet = new Bet();
        $form = $this->createForm(BetType::class, $bet, ['game' => $game]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bet);
            $entityManager->flush();

            return $this->redirectToRoute('matchs');
        }

        return $this->render('parier/new.html.twig', [
            'game' => $bet,
            'form' => $form->createView(),
        ]);
    }
}
