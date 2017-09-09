<?php namespace App\Validation;

interface ConstraintValidatorInterface
{
    public function validate($value, Constraint $constraint);
}
