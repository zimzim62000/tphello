<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Form\CharactersType;
use App\Repository\CharactersRepository;
use App\Upload\FileCharacterUpload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/characters")
 */
class CharactersController extends AbstractController
{
    /**
     * @Route("/", name="characters_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param CharactersRepository $charactersRepository
     * @return Response
     */
    public function index(CharactersRepository $charactersRepository): Response
    {
        return $this->render('characters/index.html.twig', [
            'characters' => $charactersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="characters_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param FileCharacterUpload $fileUploader
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, FileCharacterUpload $fileUploader): Response
    {
        $character = new Characters();
        $form = $this->createForm(CharactersType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader->upload($character);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($character);
            $entityManager->flush();

            return $this->redirectToRoute('characters_index');
        }

        return $this->render('characters/new.html.twig', [
            'character' => $character,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="characters_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param Characters $character
     * @return Response
     */
    public function show(Characters $character): Response
    {
        return $this->render('characters/show.html.twig', [
            'character' => $character,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="characters_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Characters $character
     * @param FileCharacterUpload $fileUploader
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, Characters $character, FileCharacterUpload $fileUploader): Response
    {
        $form = $this->createForm(CharactersType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader->upload($character);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('characters_index', [
                'id' => $character->getId(),
            ]);
        }

        return $this->render('characters/edit.html.twig', [
            'character' => $character,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="characters_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Characters $character
     * @return Response
     */
    public function delete(Request $request, Characters $character): Response
    {
        if ($this->isCsrfTokenValid('delete'.$character->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($character);
            $entityManager->flush();
        }

        return $this->redirectToRoute('characters_index');
    }
}
