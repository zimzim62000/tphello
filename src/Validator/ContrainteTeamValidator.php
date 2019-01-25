<?php

namespace App\Validator;

use App\Entity\Game;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContrainteTeamValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint App\Validator\ContrainteTeam */
        if(!$this->isValidTeam()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }


    public function isValidTeam(Game $team){
        if($team->getTeamA().equalTo($team->getTeamB())){
            return false;
        }
        return true;
    }
}
