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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/user-characters")
 */
class UserCharactersController extends AbstractController
{
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    /**
     * @Route("/", name="user_characters_index", methods={"GET"})
     */
    public function index(TokenStorageInterface $token, UserCharactersRepository $userCharactersRepository, CharactersRepository $charactersRepository, GameRepository $gameRepository): Response
    {
        return $this->render('user_characters/index.html.twig', [
            'games' => $gameRepository->findAll(),
            'user_characters' => $userCharactersRepository->findBy(['user' => $this->token->getToken()->getUser()]),
            'characters' => $charactersRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="user_characters_new", methods={"GET","POST"})
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
     */
    public function show(UserCharacters $userCharacter): Response
    {
        return $this->render('user_characters/show.html.twig', [
            'user_character' => $userCharacter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_characters_edit", methods={"GET","POST"})
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
