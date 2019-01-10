<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\WeaponUser;
use App\Entity\User;

class ActionController extends AbstractController
{
    /**
     * @Route("/action", name="action")
     */
    public function index()
    {
        $listeWeapon = $this->getUser()->getWeaponUsers();
        $listeEnnemis = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('action/index.html.twig', [
            'user' => $this->getUser(),
            'listeWeapons' => $listeWeapon,
            'listeEnnemis' => $listeEnnemis
        ]);
    }
}
