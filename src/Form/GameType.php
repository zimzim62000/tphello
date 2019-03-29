<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class GameType extends AbstractType
{
    private $token;
    private $valeurBtn;
    private $userCharacters;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

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

        if($game->getId() !== null){

            $valeurBtn = 'Modifier la partie';
        }

        else{
            $valeurBtn = 'Créer une partie';
        }

        $form->add('submit', SubmitType::class, ['label_format' => $valeurBtn]);
        $game->setDamage('0');
        $game->setReanimation('0');
        $game->setAssassination('0');
        $game->setPosition('0');
        $game->setCreatedAt(new \DateTime("now"));

        if ($this->userCharacters ==! null)
        {

            $game->setUserCharacters($this->userCharacters);
        }
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'userCharacters' => null,
        ]);
    }
}
