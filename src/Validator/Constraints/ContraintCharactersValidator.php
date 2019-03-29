<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 15:42
 */

namespace App\Validator\Constraints;

use App\Service\CharactersService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContraintCharactersValidator extends ConstraintValidator
{
    private $charactersService;

    public function __construct(CharactersService $charactersService)
    {
        $this->charactersService = $charactersService;
    }

    public function validate($value, Constraint $constraint)
    {
        if(!$constraint instanceof ContraintUserCharacter) {
            throw new UnexpectedTypeException($constraint, ContraintCharacters::class);
        }

        if($this->charactersService->verifyNameInDatabase($value) === false){
            $this->context->buildViolation($constraint->message)->addViolation();
        }


    }
}