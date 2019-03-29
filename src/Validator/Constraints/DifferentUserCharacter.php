<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 13:51
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DifferentUserCharacter extends Constraint
{
    public $message = 'Le character "{{ Character }}" existe deja pour un le user "{{ User }}" !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}