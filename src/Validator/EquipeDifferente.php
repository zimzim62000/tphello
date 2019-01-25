<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 25/01/2019
 * Time: 09:03
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraint;


class EquipeDifferente extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Les 2 equipes ne sont pas differentes';


    public function validatedBy()
    {
        return \get_class($this).'Validation';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}