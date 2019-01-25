<?php

namespace App\Form;

use App\Entity\Game;
use App\Form\Type\ScoreType;
use Symfony\Component\Form\AbstractType;
use App\Form\Type\TeamsType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('scoreTeamA',ScoreType::class)
            ->add('scoreTeamB',ScoreType::class)
            ->add('date')
            ->add('rating')
            ->add('teamA',TeamsType::class)
            ->add('teamB',TeamsType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
