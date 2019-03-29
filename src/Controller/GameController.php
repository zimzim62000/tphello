<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\UserCharacters;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Security\AppAccess;
use App\Service\Shoot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="game_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="game_new", methods={"GET","POST"}, defaults={"id"=null})
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param UserCharacters|null $userCharacters
     * @return Response
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
     * @IsGranted("ROLE_USER")
     * @param Game $game
     * @return Response
     */
    public function show(Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME_SHOW, $game);
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="game_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param Game $game
     * @return Response
     */
    public function edit(Request $request, Game $game): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::GAME_EDIT, $game);
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
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param Game $game
     * @return Response
     */
    public function delete(Request $request, Game $game): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index');
    }

    /**
     * @Route("/shoot/{id}", name="game_shoot", methods="GET")
     */
    public function shoot(Game $game, Shoot $shoot): Response
    {
        $shoot->shoot($game);

        return $this->redirectToRoute('user_characters_index');
    }
}
