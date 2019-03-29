<?php

namespace App\Form;

use App\Entity\UserCharacters;
use App\Form\Type\CharactersNotPlayedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserCharactersType extends AbstractType
{
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('favorite')
            ->add('default')
            ->add('user')
            ->add('characters',CharactersNotPlayedType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
        ]);
    }

    public function preSetData(FormEvent $event) {

        $form = $event->getForm();
        $userCharacter = $event->getData();

        if(in_array('ROLE_ADMIN', $this->token->getToken()->getUser()->getRoles()) !== true) {

            $userCharacter->setDefaultCharacter(false);
            $form->remove('default');

            $userCharacter->setFavorite(false);
            $form->remove('favorite');

            $userCharacter->setCreatedAt(new \DateTime());
            $form->remove('createdAt');

            $userCharacter->setUser($this->token->getToken()->getUser());
            $form->remove('user');
        }
    }
}
