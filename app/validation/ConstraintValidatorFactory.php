<?php namespace App\Validation;

class ConstraintValidatorFactory
{
    protected $validators = array();

    public function __construct()
    {
    }

    public function getInstance(Constraint $constraint)
    {
        $className = $constraint->validatedBy();

        if (!isset($this->validators[$className])) {
            $this->validators[$className] = new $className();
        }

        return $this->validators[$className];
    }
}