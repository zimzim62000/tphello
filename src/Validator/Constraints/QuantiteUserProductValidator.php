<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 20:05
 */

namespace App\Validator\Constraints;

use App\Entity\UserProduct;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


class QuantiteUserProductValidator extends ConstraintValidator
{
    public function validate($userProduct, Constraint $constraint)
    {
        if (!$constraint instanceof QuantiteUserProduct) {
            throw new UnexpectedTypeException($constraint, QuantiteUserProduct::class);
        }

        if(!$this->quantiteDemandeeCorrecte($userProduct)){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ userProduct }}', $userProduct->getQuantity())
                ->addViolation();
        }
    }

    public function quantiteDemandeeCorrecte(UserProduct $userProduct){
        return $userProduct->getProduct()->getQuantity() > $userProduct->getQuantity();
    }
}