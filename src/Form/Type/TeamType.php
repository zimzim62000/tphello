<?php

namespace App\Form\Type;

use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\TeamRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TeamType extends AbstractType
{
    private $token;
    private $securityChecker;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->token = $token;
        $this->securityChecker = $securityChecker;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $token = $this->token;
         $resolver->setDefaults([
            'class' => Team::class,
            'query_builder' => function (TeamRepository $team)  use ($token) {
                return $team->createQueryBuilder('t')
                    ->orderBy('t.name', 'ASC');
            },
        ]);
    }

    public function getParent(){
        return EntityType::class;
    }
}
