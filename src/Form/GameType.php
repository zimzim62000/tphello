<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\UserCharacters;
use App\Repository\UserCharactersRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class GameType extends AbstractType
{
    private $token;
    private $usercharacter;

    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->usercharacter = $options['usercharacter'];


        $builder
            ->add('createdAt')
            ->add('position')
            ->add('assassination')
            ->add('reanimation')
            ->add('damage')
            ->add('userCharacters')
            ->add('submit', SubmitType::class )
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'OnPreSetData')
        );
    }


    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $game = $event->getData();


        if ($this->usercharacter !== null) {
            $game->setCreatedAt(new \DateTime('now'));
            $game->setPosition(0);
            $game->setAssassination(0);
            $game->setReanimation(0);
            $game->setDamage(0);
            $game->setUserCharacters($this->usercharacter);

            $form->remove('createdAt')->remove('position')->remove('assassination')->remove('reanimation')->remove('damage')->remove('userCharacters');

        }

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'usercharacter' => null
        ]);
    }
}
