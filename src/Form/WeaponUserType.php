<?php

namespace App\Form;

use App\Entity\WeaponUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class WeaponUserType extends AbstractType
{
    private $securityChecker;
    private $token;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weapon')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA,array($this, 'preSetData'));
    }

    public function preSetData(FormEvent $event)
    {
        $item = $event->getData();
        $item->setActive(false);
        $item->setAmmunition(100);
        $item->setUser($this->token->getToken()->getUser());
        $item->setQuality(100);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeaponUser::class,
        ]);
    }
}
