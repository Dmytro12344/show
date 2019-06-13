<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class ContainsNotEqual_100 extends Constraint
{
    /**
     * @Annotation
     */
    public $message = 'The values must be not equal 100';

}