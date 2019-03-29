<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 15:42
 */

namespace App\Validator\Constraints;

use App\Entity\UserCharacters;
use App\Service\UserCharacterService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContraintUserCharacterValidator extends ConstraintValidator
{
    private $userCharacterService;

    public function __construct(UserCharacterService $userCharacterService)
    {
        $this->userCharacterService = $userCharacterService;
    }

    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof ContraintUserCharacter) {
            throw new UnexpectedTypeException($constraint, ContraintUserCharacter::class);
        }

        if($this->userCharacterService->validate($value) === false){
            $this->context->buildViolation($constraint->message)->addViolation();
        }


    }
}