<?php
namespace App\Validator\Constraints;

use App\Entity\UserCharacters;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\UserItem\CalculateUserWeight;

class ContainsSameUserCharacterValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsSameUserCharacter) {
            throw new UnexpectedTypeException($constraint, ContainsSameUserCharacter::class);
        }


        if (!$this->isSameUserCharacter($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ userCharacter }}', $value)
                ->addViolation();
        }
    }

        public function isSameUserCharacter(UserCharacters $value) {
            foreach($value->getUserCharacter()->getNom() as $usercharacter ) {
                if (($usercharacter->getUser() == $value->getUser()) && ($usercharacter->getCharacters() == $value->getCharacters())) {
                    return false;
                }
            }
            return true;
    }
}