<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 14:03
 */

namespace App\Form\Type;


use App\Repository\CharactersRepository;
use App\Repository\UserCharactersRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CharactersNotPlayedType extends AbstractType
{

    private $repository;
    private $tokenStorage;
    private $charactersRepository;

    public function __construct(CharactersRepository $charactersRepository, UserCharactersRepository $repository, TokenStorageInterface $tokenStorage)
    {
        $this->repository = $repository;
        $this->tokenStorage = $tokenStorage;
        $this->charactersRepository = $charactersRepository;
    }

    public function configureOptions(OptionsResolver $resolver){

        $userCharacters = $this->repository->findByPlayedByUser($this->tokenStorage->getToken()->getUser());
        $all = $this->charactersRepository->findAll();

        foreach ($userCharacters as $userCharacter){
            $played[] = $userCharacter->getCharacter;
        }
        $notPlayed = array();

        foreach ($all as $key => $character){
            if(!in_array($character,$played)) $notPlayed[] = $character;
        }

        $resolver->setDefaults([
            'choices' => $notPlayed,
            'multiple' => false,
            'expanded' => true
        ]);
    }

    public function getParent(){
        return ChoiceType::class;
    }
}