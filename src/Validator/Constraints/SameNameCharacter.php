<?php

namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class SameNameCharacter extends Constraint
{
    public $message = 'THIS NAME ALREADY EXIT !';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /*
    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    */
}