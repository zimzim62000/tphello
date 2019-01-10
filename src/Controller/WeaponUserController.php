<?php

namespace App\Controller;

use App\Entity\WeaponUser;
use App\Form\WeaponUserType;
use App\Repository\WeaponUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/weapon-user")
 */
class WeaponUserController extends AbstractController
{
    /**
     * @Route("/", name="weapon_user_index", methods="GET")
     */
    public function index(WeaponUserRepository $weaponUserRepository): Response
    {
        return $this->render('weapon_user/index.html.twig', ['weapon_users' => $weaponUserRepository->findAll()]);
    }

    /**
     * @Route("/new", name="weapon_user_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $weaponUser = new WeaponUser();
        $form = $this->createForm(WeaponUserType::class, $weaponUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weaponUser);
            $em->flush();

            return $this->redirectToRoute('action');
        }

        return $this->render('weapon_user/new.html.twig', [
            'weapon_user' => $weaponUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="weapon_user_show", methods="GET")
     */
    public function show(WeaponUser $weaponUser): Response
    {
        return $this->render('weapon_user/show.html.twig', ['weapon_user' => $weaponUser]);
    }

    /**
     * @Route("/{id}/edit", name="weapon_user_edit", methods="GET|POST")
     */
    public function edit(Request $request, WeaponUser $weaponUser): Response
    {
        $form = $this->createForm(WeaponUserType::class, $weaponUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('weapon_user_index', ['id' => $weaponUser->getId()]);
        }

        return $this->render('weapon_user/edit.html.twig', [
            'weapon_user' => $weaponUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="weapon_user_delete", methods="DELETE")
     */
    public function delete(Request $request, WeaponUser $weaponUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weaponUser->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($weaponUser);
            $em->flush();
        }

        return $this->redirectToRoute('action');
    }
}
