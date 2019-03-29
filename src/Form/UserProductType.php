<?php

namespace App\Form;

use App\Entity\UserProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserProductType extends AbstractType
{
    private $product;
    private $token;

    public function __construct(TokenStorageInterface $token)
    {
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProduct::class,
            'product' => null,
        ]);
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $userProduct = $event->getData();

        if($this->product !== null){
            $userProduct->setProduct($this->product)
                ->setUser($this->token->getToken()->getUser())
                ->setCreatedAt(new \DateTime('now'));

            $form->remove('product')
                ->remove('user')
                ->remove('userOrder')
                ->remove('createdAt');
        }
    }
}
