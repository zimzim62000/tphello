<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
    * @Annotation
*/
class ContainsMaxWeight extends Constraint
{
    public $message = 'Le poids "{{ weight }}" dépasse ce que je peux porter !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}