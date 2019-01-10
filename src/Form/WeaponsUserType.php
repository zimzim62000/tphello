<?php

namespace App\Form;

use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class WeaponsUserType extends AbstractType
{


    private $token;

    public function __construct(TokenStorageInterface $token)
    {

        $this->token = $token;

    }

//passer le service utilisateur et aller chercher que les armes
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'query_builder' => function (WeaponUserRepository $repo) use ( $token )
            return $repo -> where 'user' = $token


            ],
            'multiple' => false,
            'expanded' => true,
        ]);

    }

    public function getParent(){
        return EntityType::class;

    }




}
