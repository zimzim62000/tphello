<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 13:27
 */

namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DifferentNomCharacter extends Constraint
{
    public $message = 'Le nom "{{ nom }}" existe deja pour un autre perso !';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}