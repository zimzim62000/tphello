<?php

namespace App\Form;

use App\Entity\UserCharacters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserCharactersType extends AbstractType
{
    private $token;
    private $securityChecker;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('favorite')
            ->add('defaultCharacter')
            ->add('user')
            ->add('characters')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $userCharacters = $event->getData();

        if ($userCharacters->getId() === null) {

            if ($this->securityChecker->isGranted('ROLE_ADMIN') === false) {

                $userCharacters->setCreatedAt(new \DateTime("now"));
                $userCharacters->setFavorite(false);
                $userCharacters->setDefaultCharacter(false);
                $userCharacters->setUser($this->token->getToken()->getUser());
                $form->remove('createdAt');
                $form->remove('favorite');
                $form->remove('defaultCharacter');
                $form->remove('user');
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
        ]);
    }
}
