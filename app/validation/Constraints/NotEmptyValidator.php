<?php namespace App\Validation\Constraints;

use App\Validation\ConstraintValidator;
use App\Validation\Constraint;

class NotEmptyValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof NotEmpty) {
            throw new \TypeError(__NAMESPACE__ . '\NotEmpty');
        }

        if (null === $value || '' === $value) {
            $this->context->AddViolation($constraint->message);
        }
    }
}