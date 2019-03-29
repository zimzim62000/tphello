<?php
/**
 * Created by PhpStorm.
 * User: alexandre.picque
 * Date: 29/03/19
 * Time: 15:56
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintsTwiceUserCharacter extends Constraint
{
    public $message2 = 'Vous avez deja ce character';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;

    }

}