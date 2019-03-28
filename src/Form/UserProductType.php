<?php

namespace App\Form;

use App\Entity\UserProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\VarDumper\Cloner\Data;

class UserProductType extends AbstractType
{
    private $securityChecker;
    private $token;
    private $product;
    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->product = $options['product'];
        $builder
            ->add('quantity')
            ->add('createdAt')
            ->add('user')
            ->add('product')
            ->add('userOrder')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {

        $form = $event->getForm();
        $userProduct = $event->getData();
        if($userProduct->getId() === null){
            // un nouveau user order
        }

        if($this->product !== null){
            $userProduct->setProduct($this->product);
            $form->remove('product');
        }
        if($this->securityChecker->isGranted('ROLE_USER') === true){
            $userProduct->setUser($this->token->getToken()->getUser());
            $form->remove('user');
        }

        $userProduct->setCreatedAt(new \DateTime());
        $form->remove('createdAt');
        $form->remove('userOrder');

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProduct::class,
            'product' => null
        ]);
    }
}
