<?php

namespace App\Form;

use App\Entity\Bet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BetType extends AbstractType
{
    private $game;
    private $securityChecker;
    private $token;
    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->game = $options['game'];

        $builder
            ->add('scoreTeamA')
            ->add('scoreTeamB')
            ->add('date')
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
        if($this->game !== null){
            $bet->setGame($this->game);
            $form->remove('game');
        }
        $bet->setGame($this->game)->setUser($this->token->getToken()->getUser());
        $form->remove('user')->remove('date');


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
            'game' => null,
        ]);
    }
}
