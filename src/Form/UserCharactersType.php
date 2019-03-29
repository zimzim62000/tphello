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

		$userCharacter->setDefaultCharacter(false);
		$userCharacter->setFavorite(false);
		$userCharacter->setCreatedAt(new \DateTime());
		$userCharacter->setUser($this->token->getToken()->getUser());

		if (!$this->securityChecker->isGranted('ROLE_ADMIN'))
		{
			$form->remove('createdAt');
			$form->remove('favorite');
			$form->remove('defaultCharacter');
			$form->remove('user');
		}
	}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
        ]);
    }
}
