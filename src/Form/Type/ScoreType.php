<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ScoreType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                0,1,2,3,4,5,6,7,8,9,10,11,12
            ],
            'attr' => ['onChange' => 'changeColor(this.value)']
        ]);

    }

    public function getParent(){
        return ChoiceType::class;
    }
}
