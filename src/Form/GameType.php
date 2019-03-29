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
            ->add('submit', SubmitType::class )
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'userCharacters' => null,
        ]);
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $game = $event->getData();

        if($game->getId() === null){
            $form->add('submit', SubmitType::class, ['label_format' => 'Créer une partie']);
            $game->setCreatedAt(new \DateTime('now'))
                ->setPosition(0)
                ->setAssassination(0)
                ->setReanimation(0)
                ->setDamage(0)
                ->setUserCharacters($this->userCharacters);

            $form->remove("createdAt")
                ->remove("position")
                ->remove("assassination")
                ->remove("reanimation")
                ->remove("damage")
                ->remove("userCharacters");

        }else{
            $form->add('submit', SubmitType::class, ['label_format' => 'Modifier la partie']);
        }


        // Modification de GameType pour lors du clic sur "Créer une partie",
        // le formulaire sois automatiquement setter ( Date = now, tous les champs à 0 et userCharacter setter )
    }
}
