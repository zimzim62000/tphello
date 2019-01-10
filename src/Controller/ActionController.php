<?php

namespace App\Controller;

use App\Entity\WeaponUser;
use App\Form\WeaponsUserType;
use App\Form\WeaponUserType;
use App\Repository\UserRepository;
use App\Repository\WeaponRepository;
use App\Repository\WeaponUserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ActionController extends AbstractController
{
    /**
     * @Route("/action", name="action_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(UserRepository $repoUser, WeaponRepository $repoWeap, WeaponUserRepository $repoWeapUser)
    {
        $user = $this->getUser();
        $users = $repoUser->findAll();
        $weapons = $repoWeap->findAll();
        $weaponUser = $repoWeapUser->findBy(['user' => $user]);

        return $this->render('action/index.html.twig', [
            'user' => $user,
            'users' => $users,
            'weapons' => $weapons,
            'weaponUser' => $weaponUser
        ]);
    }

    /**
     * @Route("/action/ajouterArme", name="action_ajouter_arme", methods={"GET","POST"}))
     */
    public function ajouterArme(Request $request)
    {
        $weapUser = new WeaponUser();
        $form = $this->createForm(WeaponUserType::class, $weapUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weapUser);
            $entityManager->flush();
            return $this->redirectToRoute('action_index');
        }
        return $this->render('action/ajouterArme.html.twig', [
            'weapUser' => $weapUser,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/action/activerArme", name="action_activer_arme", methods={"GET","POST"}))
     */
    public function activerArme(Request $request)
    {
        $weapUser = new WeaponUser();
        $form = $this->createForm(WeaponsUserType::class, null);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($weapUser);
            $entityManager->flush();
            return $this->redirectToRoute('action_index');
        }
        return $this->render('action/ajouterArme.html.twig', [
            'weapUser' => $weapUser,
            'form' => $form->createView()
        ]);
    }
}
