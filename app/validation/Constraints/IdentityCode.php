<?php namespace App\Validation\Constraints;

use App\Validation\Constraint;

class IdentityCode extends Constraint
{
    public $countryCode;
    public $invalidMessage = 'This value is not valid.';
    public $invalidLengthMessage = 'This value should contain %s symbols.';
    public $validCodes = array("ee");

    public function __construct($countryCode)
    {
        if (!in_array($countryCode, $this->validCodes)) {
            throw new \InvalidArgumentException(sprintf('Parameter "countryCode" must be one of values {%s} given to constraint %s', join(", ", $this->validCodes), __CLASS__));
        }
        $this->countryCode = $countryCode;
    }
}