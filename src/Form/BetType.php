<?php

namespace App\Form;

use App\Entity\Bet;
use App\Form\Type\ScoreType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class BetType extends AbstractType
{
    private $securityChecker;
    private $token;
    private $game;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->game = $options['game'];
        $builder
            ->add('scoreTeamA', ScoreType::class)
            ->add('scoreTeamB', ScoreType::class)
            ->add('amout')
            ->add('user')
            ->add('game')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $bet = $event->getData();
        if($bet->getId() === null){
            // un nouveau bet
        }

        if($this->game !== null){
            $bet->setGame($this->game);
            $form->remove('game');
        }

        if($this->securityChecker->isGranted('ROLE_USER') === true){
            $bet->setUser($this->token->getToken()->getUser());
            $form->remove('user');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
            'game' => null
        ]);
    }
}
