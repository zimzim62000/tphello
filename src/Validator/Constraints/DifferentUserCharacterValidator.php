<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 13:28
 */

namespace App\Validator\Constraints;

use App\Entity\UserCharacters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class DifferentUserCharacterValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($userCharacter, Constraint $constraint)
    {
        if (!$constraint instanceof DifferentUserCharacter) {
            throw new UnexpectedTypeException($constraint, DifferentUserCharacter::class);
        }

        if(!$this->userCharacterCorrect($userCharacter)){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ Character }}', $userCharacter->getCharacters())
                ->setParameter('{{ User }}', $userCharacter->getUser())
                ->addViolation();
        }
    }

    public function userCharacterCorrect(UserCharacters $userCharacters){
        $user = $userCharacters->getUser();
        $character = $userCharacters->getCharacters();

        $userCharac = $this->em->getRepository(UserCharacters::class)->findAll();
        $stillExist = true;

        foreach ($userCharac as $userC){
            if( ($userC->getUser() === $user) && ($userC->getCharacters() === $character)){
                $stillExist = false;
            }
        }

        return $stillExist;

    }
}