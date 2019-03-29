<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 15:41
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContraintCharacters extends Constraint
{
    public $message = 'Unpersonnage avec ce nom existe déjà';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}