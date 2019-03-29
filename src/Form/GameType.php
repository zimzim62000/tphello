<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\UserCharacters;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GameType extends AbstractType
{

    private $label;
    private $game;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->label = $options['label'];
        $this->game = $options['game'];

        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters')
            ->add($this->label, SubmitType::class )
        ;

        if($this->label=='Créer une partie') {

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'preSetData')
            );
        }
    }

    public function preSetData(FormEvent $event)
    {
        //On récupère le formulaire
        $form = $event->getForm();
        //On réucpère la game
        $game = $event->getData();

        $game->setCreatedAt(new \DateTime());
        $form->remove('createdAt');
        $game->setPosition(0);
        $form->remove('position');
        $game->setAssassination(0);
        $form->remove('assassination');
        $game->setReanimation(0);
        $form->remove('reanimation');
        $game->setDamage(0);
        $form->remove('damage');



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'label'=>null,
            'game'=>null,
        ]);
    }
}
