<?php
declare(strict_types = 1);
use \App\Validation\Constraints\IdentityCode;

class IdentityCodeValidatorTest extends ConstraintValidatorTest
{
    protected function createValidator()
    {
        return new \App\Validation\Constraints\IdentityCodeValidator();
    }

    public function getWrongLength()
    {
        return array(
            array("ee", "123", 11)
        );
    }

    public function getInvalidCodes()
    {
        return array(
            array("ee", "33333333333"),
            array("ee", "34501234214")
        );
    }

    public function getValidCodes()
    {
        return array(
            array("ee", '34501234215')
        );
    }

    /**
     * @dataProvider getWrongLength
     */
    public function testInvalidLengthCodes($country, $code, $requiredLength)
    {
        $constraint = new IdentityCode($country);
        $this->validator->validate($code, $constraint);

        $this->assertViolation(sprintf($constraint->invalidLengthMessage, $requiredLength));
    }

    /**
     * @dataProvider getInvalidCodes
     */
    public function testInvalidCodes($country, $code)
    {
        $constraint = new IdentityCode($country);
        $this->validator->validate($code, $constraint);

        $this->assertViolation($constraint->invalidMessage);
    }

    /**
     * @dataProvider getValidCodes
     */
    public function testValidCodes($country, $code)
    {
        $this->validator->validate($code, new IdentityCode($country));

        $this->assertNoViolation();
    }
}
