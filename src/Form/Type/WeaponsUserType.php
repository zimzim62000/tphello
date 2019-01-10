<?php

namespace App\Form\Type;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class WeaponsUserType extends AbstractType
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
            'class' => WeaponUser::class,
            'query_builder' => function (WeaponUserRepository $wur)  use ($token) {
                return $wur->createQueryBuilder('wur')
                    ->where('wur = :user')
                    ->setParameter('user', $token->getToken()->getUser());
            },
        ]);
    }

    public function getParent(){
        return Entity::class;
    }
}
