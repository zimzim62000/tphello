<?php

namespace App\Handler;

use App\Entity\WeaponUser;
use App\Form\WeaponUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\Form;

use Symfony\Component\HttpFoundation\RedirectResponse;

class WeaponUserHandler
{

    private $em;
    private $session;
    private $formFactory;
    private $router;
    private $securityChecker;

    private $requestStack;
    private $weaponUser;
    private $form;

    public function __construct(FormFactoryInterface $formFactory, RouterInterface $router, AuthorizationCheckerInterface $securityChecker, EntityManagerInterface $em, SessionInterface $session)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->securityChecker = $securityChecker;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * @required
     */
    public function setRequest(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function setWeaponUser(WeaponUser $weaponUser)
    {
        $this->weaponUser = $weaponUser;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function getWeaponUser()
    {
        return $this->weaponUser;
    }

    public function proceed(): bool
    {
        $this->form = $this->formFactory->create(WeaponUserType::class, $this->weaponUser);

        $this->form->handleRequest($this->requestStack->getCurrentRequest());

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            return true;
        }
        return false;
    }

    public function treat()
    {
        $this->em->persist($this->weaponUser);
        $this->em->flush();

        $this->session->getFlashBag()->add('success', 'Arme ajouté avec succes');

        if( $this->securityChecker->isGranted('ROLE_ADMIN') === true){
            return new RedirectResponse($this->router->generate('weapon_user_index'));
        }else{
            return new RedirectResponse($this->router->generate('user_action_index'));
        }
    }
}