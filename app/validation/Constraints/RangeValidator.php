<?php

require_once __DIR__ . "/../ConstraintValidator.php";
require_once __DIR__ . "/Range.php";

class RangeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Range) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\Range');
        }

        if (null === $value) {
            return;
        }

        if (!is_numeric($value)) {
            $this->context->AddViolation($constraint->invalidMessage);
            return;
        }

        if (null != $constraint->min && $constraint->min > $value) {
            $this->context->AddViolation(sprintf($constraint->minMessage, $constraint->min));
        }

        if (null != $constraint->max && $constraint->max < $value) {
            $this->context->AddViolation(sprintf($constraint->maxMessage, $constraint->max));
        }
    }
}