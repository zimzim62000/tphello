<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 20:05
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class QuantiteUserProduct extends Constraint
{
    public $message = 'La quantite "{{ userProduct }}" dépasse la quantité dispo !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}