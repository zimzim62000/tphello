<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\UserCharacters;
use App\Form\UserCharactersType;
use App\Repository\CharactersRepository;
use App\Repository\GameRepository;
use App\Repository\UserCharactersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/user-characters")
 */
class UserCharactersController extends AbstractController
{
    /**
     * @Route("/", name="user_characters_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function index(UserCharactersRepository $userCharactersRepository, CharactersRepository $charactersRepository, GameRepository $gameRepository): Response
    {
        return $this->render('user_characters/index.html.twig', [
            'games' => $gameRepository->findAll(),
            'user_characters' => $userCharactersRepository->findBy(['user' => $this->getUser()]),
            'characters' => $charactersRepository->findBy([], ['role' => 'ASC', 'name' => 'ASC'])
        ]);
    }

    /**
     * @Route("/new", name="user_characters_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $userCharacter = new UserCharacters();
        $form = $this->createForm(UserCharactersType::class, $userCharacter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userCharacter);
            $entityManager->flush();

            return $this->redirectToRoute('user_characters_index');
        }

        return $this->render('user_characters/new.html.twig', [
            'user_character' => $userCharacter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_characters_show", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function show(UserCharacters $userCharacter): Response
    {
        return $this->render('user_characters/show.html.twig', [
            'user_character' => $userCharacter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_characters_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, UserCharacters $userCharacter): Response
    {
        $form = $this->createForm(UserCharactersType::class, $userCharacter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_characters_index', [
                'id' => $userCharacter->getId(),
            ]);
        }

        return $this->render('user_characters/edit.html.twig', [
            'user_character' => $userCharacter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_characters_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, UserCharacters $userCharacter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userCharacter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userCharacter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_characters_index');
    }
}
