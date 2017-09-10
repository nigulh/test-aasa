<?php namespace App\Validation\Constraints;
use App\Validation\ConstraintValidator;
use App\Validation\Constraint;

class RegexValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Regex) {
            throw new \TypeError(__NAMESPACE__ . '\Regex');
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new \TypeError('string');
        }

        $value = (string) $value;

        if (!preg_match($constraint->pattern, $value)) {
            $this->context->AddViolation($constraint->message);
        }
    }
}