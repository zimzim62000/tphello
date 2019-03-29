<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 21:27
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DiscountType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'expanded' => true,
            'choices'  => [
                0 => '0',
                "5" => 5,
                '10' => 10,
                '15' => 15,
                '30' => 30,
                '50' => 50,
            ],
            'attr' => ['onChange' => 'changeColor(this)'],
        ]);
    }
    public function getParent(){
        return ChoiceType::class;
    }
}