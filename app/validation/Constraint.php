<?php namespace App\Validation;

abstract class Constraint
{
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}