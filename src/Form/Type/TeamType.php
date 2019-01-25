<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 25/01/2019
 * Time: 09:34
 */

namespace App\Form\Type;


use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class TeamType extends AbstractType
{
    private $securityChecker;
    private $token;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $token = $this->token;

        $resolver->setDefaults([
            'class' => Team::class,
            'query_builder' => function(TeamRepository $team) use ($token) {
                return $team->createQueryBuilder('team')
                    ->orderBy('team.name', 'ASC');
            }
        ]);

    }

    public function getParent(){
        return EntityType::class;
    }

}