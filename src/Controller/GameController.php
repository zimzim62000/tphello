<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\UserCharacters;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Service\Game\ShootWeapon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/new/{id}", name="game_new", methods={"GET","POST"}, defaults={"id"=null})
     */
    public function new(Request $request, UserCharacters $id=null): Response
    {
        //$this->denyAccessUnlessGranted('gameNew');
        $game = new Game();
        $form = $this->createForm(GameType::class, $game, ['type' => "new", "id" => $id]);
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
        //$this->denyAccessUnlessGranted('gameShow', $game);
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="game_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Game $game): Response
    {
        //$this->denyAccessUnlessGranted('gameEdit', $game);
        $form = $this->createForm(GameType::class, $game, ["type" => "edit"]);
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
        //$this->denyAccessUnlessGranted('gameDelete', $game);
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index');
    }

    /**
     * @Route("/shootgame/{id}", name="shoot_game", methods="GET")
     */
    public function shootGame(Game $game, ShootWeapon $shootWeapon){

        $shootWeapon->shoot($game);
        return $this->redirectToRoute('user_characters_index');
    }
}
