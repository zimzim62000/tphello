<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 13:28
 */

namespace App\Validator\Constraints;


use App\Entity\Characters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class DifferentNomCharacterValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($character, Constraint $constraint)
    {
        if (!$constraint instanceof DifferentNomCharacter) {
            throw new UnexpectedTypeException($constraint, DifferentNomCharacter::class);
        }

        if(!$this->nomCharacterCorrect($character)){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ nom }}', $character->getName())
                ->addViolation();
        }
    }

    public function nomCharacterCorrect(Characters $character){
        $characters = $this->em->getRepository(Characters::class)->findAll();
        $nameExist = true;
        foreach ($characters as $charac){
            if($charac->getName() === $character->getName()){
                $nameExist = false;
            }
        }

        return $nameExist;

    }
}