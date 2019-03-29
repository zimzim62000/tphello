<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 29/03/2019
 * Time: 13:50
 */


namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Characters;

class CharactersNameValidator extends ConstraintValidator
{
    private $em;
    private $charactersName;
    public function __construct(EntityManagerInterface $em, CharactersName $charactersName)
    {
        $this->em = $em;
        $this->charactersName = $charactersName;
    }
    public function validate($item, Constraint $constraint)
    {
        if (!$constraint instanceof CharactersName) {
            throw new UnexpectedTypeException($constraint, CharactersName::class);
        }
        $nameExiste = $this->em->getRepository(Characters::class)->findAll();

        if ($nameExiste===$this->charactersName) {
            $this->context->buildViolation($constraint->message)
                ->atPath('name')
                ->addViolation();
        }

    }
}
