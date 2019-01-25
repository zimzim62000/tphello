<?php


namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContrainteEquipe extends Constraint
{
    /**
     * @var string
     */
    public $message = 'les 2 equipes ne sont pas differentes';


    public function validatedBy()
    {
        return \get_class($this) . 'Validation';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}