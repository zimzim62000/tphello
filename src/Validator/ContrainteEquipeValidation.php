<?php

namespace App\Validator;


use App\Entity\Game;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContrainteEquipeValidation extends ConstraintValidator {

    protected $em;
    public function __construct(ObjectManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint) {
        if (null === $value || '' === $value) {
            return;
        }

        if (!($value instanceof Game)) {
            throw new UnexpectedTypeException($value, 'Game');
        }

        if (!$this->isEquipeDiff($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
    public function isEquipeDiff(Game $ga) {
        if($ga->getTeamA() === $ga->getTeamB()){
             return false;
        }
        return true;
    }

}