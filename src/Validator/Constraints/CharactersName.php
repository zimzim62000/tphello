<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 29/03/2019
 * Time: 13:50
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
    * @Annotation
 */
class CharactersName extends Constraint
{

    public $message = '2 fois le même nom !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
