<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DifferentCharacter extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The character "{{ value }}" is already created.';
}
