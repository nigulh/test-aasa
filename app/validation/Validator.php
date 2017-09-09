<?php

class Validator {
    protected $fieldConstraints;

    public function __construct() {
        $this->validatorFactory = new ConstraintValidatorFactory();
    }

    public function addFieldConstraint(String $fieldName, Constraint $constraint) {
        if (!array_key_exists($fieldName, $this->fieldConstraints)) {
            $this->fieldConstraints[$fieldName] = array();
        }
        $this->fieldConstraints[$fieldName][] = $constraint;
    }
    
    public function validate($value) {
        $context = new ValidationContext();
        foreach ($this->fieldConstraints as $fieldName => $constraints) {
            foreach ($constraints as $constraint) {
                $validator = $this->validatorFactory->getInstance($constraint);
                $context->SetCurrentFieldName($fieldName);
                $validator->initialize($context);
                $validator->validate($value, $constraint);
            }
        }
    }
}