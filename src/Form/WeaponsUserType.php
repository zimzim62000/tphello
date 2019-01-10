<?php

namespace App\Form;

use App\Entity\Weapon;
use App\Entity\WeaponUser;
use App\Repository\WeaponUserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class WeaponsUserType extends AbstractType
{
    private $securityChecker;
    private $token;
    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weapon',EntityType::class, [
                'class' => WeaponUser::class,
                'choice_label' => 'weapon.name',
                'query_builder' => function (WeaponUserRepository $er) {
                    return $er->createQueryBuilder('wp')
                        ->where('wp.user = :user')
                        ->setParameter('user', $this->token->getToken()->getUser());}
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeaponUser::class,
        ]);
    }
}
