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
    private $user_characters;
    protected $auth;

    public function __construct( TokenStorageInterface $token,AuthorizationCheckerInterface $auth)
    {
        $this->token = $token;
        $this->auth = $auth;

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user_characters=$options['user_characters'];

        $builder
            ->add('createdAt')
            ->add('favorite')
            ->add('defaultCharacter')
            ->add('user')
            ->add('characters')

        ->addEventListener(
        FormEvents::PRE_SET_DATA,
        [$this, 'onPreSetData']);
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $usercharacter = $event->getData();
        if ($this->user_characters!==null) {

            if(!$this->auth->isGranted('ROLE_ADMIN')) {
                $usercharacter->setFavorite('False');
                $usercharacter->setDefaultCharacter('False');
                $usercharacter->setUser($this->token->getToken()->getUser());
                $usercharacter->setCreatedAt(new \DateTime());
                $form->remove('favorite')->remove('default')->remove('createdAt')->remove("user");
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
            'user_characters' => null
        ]);
    }
}
