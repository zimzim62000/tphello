<?php
/**
 * Created by PhpStorm.
 * User: amaury.beauchamp
 * Date: 29/03/19
 * Time: 14:51
 */

namespace App\Validator;


use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class SameUserCharacter extends Constraint
{
    public $message = 'TU NE PEUX PAS, STOP !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}