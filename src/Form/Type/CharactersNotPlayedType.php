<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 14:03
 */

namespace App\Form\Type;


use App\Repository\UserCharactersRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharactersNotPlayedType extends AbstractType
{

    private $repository;

    public function __construct(UserCharactersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'choices' => $this->repository->findByNotPlayed(),
            'multiple' => false,
            'expanded' => true
        ]);
    }

    public function getParent(){
        return ChoiceType::class;
    }
}