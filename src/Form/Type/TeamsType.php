<?php

namespace App\Form\Type;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TeamsType extends AbstractType
{

    private $securityChecker;

    public function __construct(AuthorizationCheckerInterface $securityChecker)
    {
        $this->securityChecker = $securityChecker;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Team::class,
            'query_builder' => function (TeamRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.name', 'ASC');
            },
        ]);
    }
    public function getParent(){
        return EntityType::class;
    }




}
