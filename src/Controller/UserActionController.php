<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user-action")
 */
class UserActionController extends AbstractController
{
    /**
     * @Route("/", name="user_action_index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('user_action/index.html.twig');
    }
}
