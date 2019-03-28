<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ProductQuantity extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'TU PRENDS PLUS QUE CE QUIL Y A DE DISPO STOP.';
}
