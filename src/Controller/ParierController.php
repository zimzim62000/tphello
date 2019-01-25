<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Entity\Game;
use App\Form\BetType;
use App\Repository\BetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class ParierController extends AbstractController
{
    /**
     * @Route("/parier/voir/{id}", name="voir_pari_match", methods="GET")
     */
    public function voirPari(Game $game, BetRepository $betRepository){
        $bet = $betRepository->findOneBy(['game' => $game, 'user' => $this->getUser()]);

        if(is_null($bet))
            return $this->redirectToRoute('parier_match', ['id' => $game->getId()]);


        return $this->render('parier/show.html.twig', [
            'bet' => $bet
        ]);
    }

    /**
     * @Route("/parier/{id}", name="parier_match", methods={"GET","POST"})
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
            'bet' => $bet,
            'form' => $form->createView(),
        ]);
    }
}
