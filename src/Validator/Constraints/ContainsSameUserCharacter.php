<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class ContainsSameUserCharacter extends Constraint
{
    public $message = 'User et character déjà utilisés ';
    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}