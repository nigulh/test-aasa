<?php namespace App\Validation\Constraints;
use App\Validation\ConstraintValidator;
use App\Validation\Constraint;

class IdentityCodeValidator extends ConstraintValidator
{
    public $requiredLength = array("ee" => 11);

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof IdentityCode) {
            throw new \TypeError(__NAMESPACE__ . '\IdentityCode');
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new \TypeError('string');
        }

        $value = (string) $value;
        $countryCode = $constraint->countryCode;
        if (array_key_exists($countryCode, $this->requiredLength)) {
            $requiredLength = $this->requiredLength[$countryCode];
            if (strlen($value) != $requiredLength) {
                $this->context->AddViolation(sprintf($constraint->invalidLengthMessage, $requiredLength));
                return;
            }
        }

        if ($countryCode == "ee" && !$this->isValidEstonianCode($value)) {
            $this->context->AddViolation($constraint->invalidMessage);
        }
    }

    public function isValidEstonianCode($value) {
        $century = 18 + (intval(substr($value, 0, 1)) + 1) / 2;
        $year = $century * 100 + intval(substr($value, 1, 2));
        $month = intval(substr($value, 3, 2));
        $day = intval(substr($value, 5, 2));
        $date = mktime(0, 0, 0, $month, $day, $year);
        if (date("j", $date) != $day || date("n", $date) != $month || date("Y", $date) != $year) {
            return false;
        }
        $digits = array_map('intval', str_split($value));
        $dotProduct = function($arr1, $arr2) { return array_sum(array_map(function($a, $b) { return $a * $b; }, $arr1, $arr2)); };
        $checkSum = $dotProduct(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 1, 0), $digits) % 11;
        if ($checkSum == 10) {
            $checkSum = $dotProduct(array(3, 4, 5, 6, 7, 8, 9, 1, 2, 3, 0), $digits) % 11 % 10;
        }
        return $checkSum == $digits[10];
    }
}