<?php

namespace App\Form;

use App\Entity\UserProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class UserProductType extends AbstractType
{
    private $token;
    private $product;


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
            array($this, 'OnPreSetData')
        );
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $userproduct = $event->getData();

        if($this->product !== null) {
            $userproduct->setUser($this->token->getToken()->getUser());
            $userproduct->setProduct($this->product);
            $userproduct->setCreatedAt(new \DateTime());

            $form->remove('createdAt')->remove('user')->remove('product')->remove('userOrder');
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserProduct::class,
            'product' => null
        ]);
    }
}
