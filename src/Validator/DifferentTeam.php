<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DifferentTeam extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'The value "{{ value }}" must be different from teamB.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
