<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\UserCharacters;
use App\Event\AppEvent;
use App\Event\EndGameEvent;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/game")
 *
 * @IsGranted("ROLE_USER")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="game_index", methods={"GET"})
     */
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{userCharacters}", name="game_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserCharacters $userCharacters = null): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game, ['userCharacters' => $userCharacters]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('game_index');
        }

        return $this->render('game/new.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_show", methods={"GET"})
     */
    public function show(Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME, $game);
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/endGame", name="game_endgame", methods={"GET"})
     */
    public function endGame(EndGameEvent $endGameEvent, EventDispatcherInterface $dispatcher,Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME, $game);

        $endGameEvent->setGame($game);
        $dispatcher->dispatch(AppEvent::EndGame, $endGameEvent);

        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="game_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME, $game);

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_index', [
                'id' => $game->getId(),
            ]);
        }

        return $this->render('game/edit.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME, $game);

        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index');
    }
}
