<?php

namespace App\Controller;


use App\Entity\ActionUser;
use App\Event\ActionEvent;
use App\Event\AppEvent;
use App\Form\Type\ActionType;
use App\Repository\GameRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\EventDispatcher\Event;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods="GET")
     */
    public function index(Request $request, TranslatorInterface $translator, SessionInterface $session): Response
    {
        return $this->render('home/index.html.twig');
    }
}
