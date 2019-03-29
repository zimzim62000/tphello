<?php

namespace App\Form;

use App\Entity\UserCharacters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $userCharacter = $event->getData();

        if($userCharacter->getId() === null) {

            if ($this->securityChecker->isGranted('ROLE_ADMIN') === false) {

                $userCharacter->setUser($this->token->getToken()->getUser())
                    ->setCreatedAt(new \DateTime('now'));

                $userCharacter->setDefaultCharacter(false);

                $userCharacter->setFavorite(false);

                $form->remove('character')
                    ->remove('user')
                    ->remove('favorite')
                    ->remove('defaultCharacter')
                    ->remove('createdAt');
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
