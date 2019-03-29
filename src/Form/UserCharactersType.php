<?php

namespace App\Form;

use App\Entity\UserCharacters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserCharactersType extends AbstractType
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
        ]);
    }


    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $userCharacters = $event->getData();

        if($this->securityChecker->isGranted('ROLE_USER') === true && $this->securityChecker->isGranted('ROLE_ADMIN') === false){
            $userCharacters->setUser($this->token->getToken()->getUser());
            $userCharacters->setDefaultCharacter(false);
            $userCharacters->setFavorite(false);
            $userCharacters->setCreatedAt(new \DateTime('now'));

            $form->remove('user');
            $form->remove('defaultCharacter');
            $form->remove('favorite');
            $form->remove('createdAt');
        }
    }
}

// Modification du formulaire UserCharactersType:new pour que seul le champs Character sois visible
// ( Default = false, Favorite = false, date = now et user set) mais les champs doivent toujours etre disponible pour les ROLE_ADMIN
