<?php

namespace App\Form;

use App\Entity\UserCharacters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserCharactersType extends AbstractType
{

    private $token;
    private $character;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->character = $options['character'];


        $builder
            ->add('createdAt')
            ->add('favorite')
            ->add('defaultCharacter')
            ->add('user')
            ->add('characters')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'OnPreSetData')
        );
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $usercharacter = $event->getData();


        if ($this->token->getToken()->getUser()->isGranted('ROLE_ADMIN')) {
            if ($this->character === null) {
                $usercharacter->setUser($this->token->getToken()->getUser());
                $usercharacter->setCharacters($this->character);
                $usercharacter->setDefaultCharacter(false);
                $usercharacter->setFavorite(false);
                $usercharacter->setCreatedAt(new \DateTime());
            }
        }
        else {
            if ($this->character === null) {
                $usercharacter->setUser($this->token->getToken()->getUser());
                $usercharacter->setCharacters($this->character);
                $usercharacter->setDefaultCharacter(false);
                $usercharacter->setFavorite(false);
                $usercharacter->setCreatedAt(new \DateTime());
                $form->remove('createdAt')->remove('favorite')->remove('defaultCharacter')->remove('user');
            }
        }

    }

        public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
            'character' => null
        ]);
    }
}
