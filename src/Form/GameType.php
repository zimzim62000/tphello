<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters')
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }

    public function preSetData(FormEvent $event)
    {

        $form = $event->getForm();
        $gameform = $event->getData();

        $form->remove('submit');

        if ($gameform->getId() !== null) $formOptions = ['label' => 'Modifier la partie' ];
        else {

            $formOptions = ['label' => 'Créer une partie' ];
        }

        $form->add('submit', SubmitType::class, $formOptions);

    }
}
