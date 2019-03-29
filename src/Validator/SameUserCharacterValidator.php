<?php
/**
 * Created by PhpStorm.
 * User: amaury.beauchamp
 * Date: 29/03/19
 * Time: 14:52
 */

namespace App\Validator;
use App\Entity\UserCharacters;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SameUserCharacterValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof SameUserCharacter) {
            throw new UnexpectedTypeException($constraint, SameUserCharacter::class);
        }

        if (!$this->same($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    public function same(UserCharacters $value)
    {
        $user = $value->getUser();
        $character = $value->getCharacters();

        if ($user === $value->getUser()) {
            return true;
        }
        if ($character === $value->getCharacters()) {
            return true;
        }
        return false;
    }
}