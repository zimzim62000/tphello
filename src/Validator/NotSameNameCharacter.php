<?php
/**
 * Created by PhpStorm.
 * User: alexandre.picque
 * Date: 29/03/19
 * Time: 14:42
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotSameNameCharacter extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public $message = 'The character "{{ value }}" is already created.';
}
