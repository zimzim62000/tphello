<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 14:00
 */

namespace App\Form\Type;


use App\Entity\Characters;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharactersType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Characters::class,
            'multiple' => false,
            'expanded' => false,
        ]);
    }

    public function getParent(){
        return EntityType::class;
    }
}