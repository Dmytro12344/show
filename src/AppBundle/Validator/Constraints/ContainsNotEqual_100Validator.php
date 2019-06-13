<?php


namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsNotEqual_100Validator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint) : void
    {
        if($value !== 100)
        {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}