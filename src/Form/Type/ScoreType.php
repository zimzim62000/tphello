<?php
/**
 * Created by PhpStorm.
 * User: axelsulanowski
 * Date: 25/01/2019
 * Time: 09:35
 */



namespace App\Form\Type;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


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