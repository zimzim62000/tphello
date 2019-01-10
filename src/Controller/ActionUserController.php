<?php

namespace App\Controller;

use App\Entity\User;

use App\Repository\WeaponUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * @Route("/action_user")
 */
class ActionUserController extends AbstractController
{
    /**
     * @Route("/", name="action_user_index", methods="GET")
     */
    public function index(WeaponUserRepository $weaponUserRepository): Response
    {

        $user = $this->getUser();




        return $this->render('actions_user/index.html.twig', ['weapon_user' => $weaponUserRepository->findBy(['user' => $user ])]);
    }
}