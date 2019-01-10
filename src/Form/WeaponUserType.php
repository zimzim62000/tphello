<?php

namespace App\Form;

use App\Entity\Weapon;
use App\Entity\WeaponUser;
use App\Form\Type\QualityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class WeaponUserType extends AbstractType
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
            ->add('quality',QualityType::class)
            ->add('weapon',EntityType::class, [
                'class' => Weapon::class,
                'choice_label' => 'name',
            ])
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $item = $event->getData();
        //@explain item create
        if($item->getId() === null){
            $item->setUser($this->token->getToken()-> getUser());
            $form->remove('user');
            $item->setAmmunition(100);
            $item->setActive(false);

        }else{
            $form->remove('user');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeaponUser::class,
        ]);
    }
}
