<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\DateTime;

class GameType extends AbstractType
{
    private $type;
    private $userCharacter;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $this->type = $options["type"];
       $this->userCharacter = $options['id'];

        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters');

        switch ($this->type) {
            case "new" :
                $builder->add('Creer une partie', SubmitType::class);
                break;
            case "edit":
                $builder->add('Modifier la partie', SubmitType::class);
                break;
            default:
                return;
        }


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'type'=> null,
            'id' => null
        ]);
    }

    public function preSetData(FormEvent $event)
    {

        if ($this->type == "new") {
            $form = $event->getForm();
            $game = $event->getData();
            $game->setCreatedAt(new \DateTime());
            $game->setPosition(0);
            $game->setEndGame(false);
            $game->setAssassination(0);
            $game->setReanimation(0);
            $game->setDamage(0);
            $game->setUserCharacters($this->userCharacter);

            $form->remove("createdAt");
            $form->remove("position");
            $form->remove("assassination");
            $form->remove("reanimation");
            $form->remove("damage");
            $form->remove("userCharacters");

        }

    }
}
