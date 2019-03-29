<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GameType extends AbstractType
{
    private $token;
    private $gameT;


    public function __construct( TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->gameT=$options['gameT'];

        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters')
            ->add('submit', SubmitType::class );
               $builder->addEventListener(
                   FormEvents::PRE_SET_DATA,
                   array($this, 'onPreSetData')
               )
        ;
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $gameData = $event->getData();
        $gameData->setAssassination(1);
        $gameData->setReanimation(1);
        $gameData->setPosition(1);
        $gameData->setDamage(1);
        $gameData->setEndGame(1);
        $gameData->setCreatedAt(new \DateTime());
        $gameData->setUserCharacters($this->gameT);
        $form->remove('position')->remove('reanimation')->remove('createdAt')->remove("damage")->remove('assassination')->remove('userCharacters');


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'gameT' => null
        ]);
    }
}
