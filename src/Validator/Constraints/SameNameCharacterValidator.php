<?php

namespace App\Validator\Constraints;

use App\Entity\Characters;
use App\Validator\Constraints\SameNameCharacter;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SameNameCharacterValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        /*
        if (!$constraint instanceof SameNameCharacter) {
            throw new UnexpectedTypeException($constraint, SameNameCharacter::class);
        }
        */

        /* @var $constraint App\Validator\Constraints\SameNameCharacter */
        $characters = $this->em->getRepository(Characters::class)->findAll();
        foreach ($characters as $character){
            if ($character->name == $value){
                return false;
            }
        }
        return true;
    }
}
