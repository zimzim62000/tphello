<?php

namespace App\Form;

use App\Entity\WeaponUser;
use App\Form\Type\QualityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class WeaponUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quality',QualityType::class)
            ->add('ammunition')
            ->add('active')
        ;
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeaponUser::class,
        ]);
    }

    public function preSetData(FormEvent $event){
        $form = $event->getForm();
        $weapon= $event->getData();

        $weapon->setActive(false);
        $weapon->setAmmunition(100);

    }


}
