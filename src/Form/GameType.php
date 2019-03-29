<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GameType extends AbstractType
{
    private $securityChecker;
    private $token;
    private $userCharacter;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->userCharacter = $options['userCharacters'];
        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters')
            ->add('submit', SubmitType::class )
        ;
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $game = $event->getData();

        if($game->getId() === null) {
            $form->add('submit', SubmitType::class, ['label_format' => 'Créer une partie ']);
        }
        $form->add('submit', SubmitType::class, ['label_format' => 'Modifier la partie']);

        if ($this->userCharacter !== null) {
            $game->setUserCharacters($this->userCharacter)
                ->setPosition(0)
                ->setAssassination(0)
                ->setReanimation(0)
                ->setDamage(0)
                ->setCreatedAt(new \DateTime('now'))
                ->setEndGame(false);
        }

        $form->remove('userCharacters')
            ->remove('createdAt')
            ->remove('position')
            ->remove('damage')
            ->remove('assassination')
            ->remove('reanimation');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'userCharacters' => null
        ]);
    }
}
