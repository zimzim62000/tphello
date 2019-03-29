<?php

namespace App\Form;

use App\Form\Type\CharactersType;
use App\Entity\UserCharacters;
use App\Repository\CharactersRepository;
use App\Repository\UserCharactersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserCharactersType extends AbstractType
{
    private $securityChecker;
    private $token;
    private $em;


    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token, EntityManagerInterface $em)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
        $this->em = $em;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('favorite')
            ->add('defaultCharacter')
            ->add('user')
            ->add('characters', CharactersType::class)
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharacters::class,
        ]);
    }


    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $userCharacters = $event->getData();


        if($this->securityChecker->isGranted('ROLE_USER') === true && $this->securityChecker->isGranted('ROLE_ADMIN') === false){
            $userCharacters->setUser($this->token->getToken()->getUser());
            $userCharacters->setDefaultCharacter(false);
            $userCharacters->setFavorite(false);
            $userCharacters->setCreatedAt(new \DateTime('now'));

            $form->remove('user');
            $form->remove('defaultCharacter');
            $form->remove('favorite');
            $form->remove('createdAt');
        }


        /*
        $form->add('characters', CharactersType::class, [
            'query_builder' => function (CharactersRepository $charactersRepository) {
                return $charactersRepository->createQueryBuilder('character')
                    ->where('character.id in :ids')
                    ->setParameter('ids', $this->ids);// merci PHP7
            },
        ]);
        */
    }
}

// Modification du formulaire UserCharactersType:new pour que seul le champs Character sois visible
// ( Default = false, Favorite = false, date = now et user set) mais les champs doivent toujours etre disponible pour les ROLE_ADMIN
