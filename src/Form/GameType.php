<?php

namespace App\Form;

use App\Entity\Game;
use App\Form\Type\ScoreType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('scoreTeamA',ScoreType::class)
            ->add('scoreTeamB',ScoreType::class)
            ->add('date')
            ->add('rating')
            ->add('teamA',\App\Form\Type\TeamType::class)
            ->add('teamB',\App\Form\Type\TeamType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
