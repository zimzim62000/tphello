<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GameType extends AbstractType
{
    private $userCharacters;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->userCharacters = $options['userCharacters'];
        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters')
            ->add('submit', SubmitType::class , ['label' => 'Modifier une partie'])
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
        if ($game->getId() === null) {
            $form->remove('submit')->add('submit',SubmitType::class, ['label' => 'Créer une partie']);
        }
        if($this->userCharacters ==! null)
        {
            $game->setUserCharacters($this->userCharacters);
            $form->remove('userCharacters');
        }
        $game->setCreatedAt(new \DateTime())
            ->setReanimation(0)
            ->setPosition(0)
            ->setEndGame(false)
            ->setDamage(0)
            ->setAssassination(0);

        $form->remove('createdAt')
            ->remove('reanimation')
            ->remove('position')
            ->remove('assassination')
            ->remove('damage');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'userCharacters' => null
        ]);
    }
}
