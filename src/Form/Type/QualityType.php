<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QualityType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'legendaire' => 5 ,
                'epique' => 3 ,
                'rare' => 2,
                'commun' => 1,
                'délabré' => -1

            ],
            'multiple' => false,
            'expanded' => true,
        ]);

    }

    public function getParent(){
        return ChoiceType::class;

    }
}