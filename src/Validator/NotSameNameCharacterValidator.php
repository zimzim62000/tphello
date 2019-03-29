<?php
/**
 * Created by PhpStorm.
 * User: alexandre.picque
 * Date: 29/03/19
 * Time: 14:43
 */

namespace App\Validator;

use App\Entity\Characters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotSameNameCharacterValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\NotSameNameCharacter */

        if($this->isAlreadyCreated($value))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value->getName())
                ->addViolation();
        }
    }

    public function isAlreadyCreated(Characters $value)
    {
        $name = $value->getName();
        $exist = $this->em->getRepository(Characters::class)
            ->findOneBy(['name' => $name]);

        if ($exist !== null) {return true;}

        return false;
    }
}
