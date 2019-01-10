<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Weapon;
use App\Repository\UserRepository;
use App\Repository\WeaponRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionsController extends AbstractController
{
    /**
     * @Route("/actions", name="actions_index")
     */
    public function index(UserRepository $userRepository, WeaponRepository $weaponRepository)
    {
		return $this->render('actions/index.html.twig', ['users' => $userRepository->findAll(), 'weapons' => $weaponRepository->findAll()]);
    }
}
