<?php
namespace App\Form\Type;

use App\Entity\Characters;
use App\Entity\UserCharacters;
use App\Repository\CharactersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CharactersFormType extends AbstractType
{
    private $token;
    private $em;
    public function __construct(TokenStorageInterface $token, EntityManagerInterface $em)
    {
        $this->token = $token;
        $this->em = $em;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $token = $this->token;
        $usersCharacters =  $this->em->getRepository(UserCharacters::class)->findby(["user" => $token->getToken()->getUser()]);

        $resolver->setDefaults([
            'class' => Characters::class,
            'query_builder' => function (CharactersRepository $cr)  use ($token, $usersCharacters) {
                return $cr->createQueryBuilder('')
                    ->where('cr not in :usercharacters')
                    ->setParameter('usercharacters', implode(',',$usersCharacters));
            },
        ]);
    }
    public function getParent(){
        return EntityType::class;
    }
}