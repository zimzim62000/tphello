<?php

namespace App\Validator;

use App\Entity\UserProduct;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductQuantityValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint App\Validator\ProductQuantity */

        /**
         * if quantity > a l'autre bah ya probleme
         */
        if (!$this->isEnoughQuantity($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    public function isEnoughQuantity(UserProduct $value)
    {
        $produit = $value->getProduct();
        if ($produit->getQuantity() > $value->getQuantity()) {
            return true;
        }
        return false;
    }


}
