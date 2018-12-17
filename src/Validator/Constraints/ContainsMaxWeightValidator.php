<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

use Doctrine\ORM\EntityManagerInterface;
use App\UserItem\CalculateUserWeight;

class ContainsMaxWeightValidator extends ConstraintValidator
{
    private $em;
    private $calculateUserWeight;

    public function __construct(EntityManagerInterface $em, CalculateUserWeight $calculateUserWeight)
    {
        $this->em = $em;
        $this->calculateUserWeight = $calculateUserWeight;
    }

    public function validate($item, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsMaxWeight) {
            throw new UnexpectedTypeException($constraint, ContainsMaxWeight::class);
        }

        /*@todo fix me*/
        $weightUser = $this->calculateUserWeight->calculate($item->getUser());
        $weight = 10;


        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ weight }}', $weight)
            ->addViolation();

    }
}
