<?php
/**
 * Created by PhpStorm.
 * User: alexandre.picque
 * Date: 29/03/19
 * Time: 15:57
 */

namespace App\Validator\Constraints;

use App\Entity\UserCharacters;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;

class ConstraintsTwiceUserCharacterValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($item, Constraint $constraint)
    {

        if($this->sameCharacter($item)){

            $this->context->buildViolation($constraint->message2)
                ->setParameter('{{ user }}', $item->getUser()->getEmail())
                ->setParameter('{{ characters }}', $item->getCharacters()->getName())
                ->addViolation();

        }

    }

    public function sameCharacter(UserCharacters $userCharacters)
    {
        $user = $userCharacters->getUser();
        $characters = $userCharacters->getCharacters();

        $check = $this->em->getRepository(UserCharacters::class)->findOneBy(['characters' => $characters, 'user' => $user]);

        if ($check == null) {
            return false;
        }
        return true;

    }
}