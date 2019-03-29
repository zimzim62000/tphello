<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GameType extends AbstractType
{
    private $type;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $type = $options["type"];
        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters');

        switch ($type) {
            case "new" :
                $builder->add('Creer une partie', SubmitType::class);
                break;
            case "edit":
                $builder->add('Modifier la partie', SubmitType::class);
                break;
            default:
                return;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'type'=> null
        ]);
    }
}
