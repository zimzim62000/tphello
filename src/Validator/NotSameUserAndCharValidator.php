<?php

namespace App\Validator;

use App\Entity\UserCharacters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotSameUserAndCharValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\NotSameUserAndChar */

        if($this->isAlreadyCreated($value))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ user }}', $value->getUser()->getEmail())
                ->setParameter('{{ char }}', $value->getCharacters()->getName())
                ->addViolation();
        }

    }

    public function isAlreadyCreated(UserCharacters $value)
    {
        $user = $value->getUser();
        $char = $value->getCharacters();
        $exist = $this->em->getRepository(UserCharacters::class)->findOneBy(['user' => $user, 'characters' => $char]);
        if ($exist !== null) { // si c'est pas null, il existe
            return true;
        }

        return false;
    }
}
