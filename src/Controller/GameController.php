<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\UserCharacters;
use App\Event\AppEvent;
use App\Event\GameEvent;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Security\AppAccess;
use App\Service\LetsShoot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
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
     * @Route("/new/{userCharacters}", name="game_new", methods={"GET","POST"}, defaults={"userCharacters"=null})
     */
    public function new(Request $request, UserCharacters $userCharacters = null): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game, ["userCharacters" => $userCharacters]);
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
        $this->denyAccessUnlessGranted(AppAccess::GAME_METHODS, $game);

        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="game_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME_METHODS, $game);

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
        $this->denyAccessUnlessGranted(AppAccess::GAME_METHODS, $game);

        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index');
    }

    /**
     * @Route("/{id}/shoot", name="game_shoot", methods={"GET","POST"})
     */
    public function shoot(Request $request, Game $game, LetsShoot $letsShoot): Response
    {
        $game = $letsShoot->shoot($game, rand(1, 10));
        $em = $this->getDoctrine()->getManager();
        $em->persist($game);
        $em->flush();
        return $this->redirectToRoute('user_characters_index');
    }

    /**
     * @Route("/{id}/endgame", name="game_endgame", methods={"GET","POST"})
     */
    public function endgame(Request $request, Game $game, GameEvent $event, EventDispatcherInterface $dispatcher): Response
    {
        $event->setGame($game);
        $dispatcher->dispatch(AppEvent::GameEnd, $event);

        return $this->redirectToRoute('user_characters_index');
    }
}
