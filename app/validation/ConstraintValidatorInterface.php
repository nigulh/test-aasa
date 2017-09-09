<?php

interface ConstraintValidatorInterface
{
    public function validate($value, Constraint $constraint);
}
