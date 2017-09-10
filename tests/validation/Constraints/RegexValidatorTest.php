<?php
declare(strict_types=1);

use App\Validation\Constraints\Regex;
use App\Validation\Constraints\RegexValidator;

class RegexValidatorTest extends ConstraintValidatorTest
{
    protected function createValidator()
    {
        return new RegexValidator();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Regex('/^[0-9]+$/'));

        $this->assertNoViolation();
    }

    /**
     * @expectedException \TypeError
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new Regex('/^[0-9]+$/'));
    }

    /**
     * @dataProvider getValidValues
     */
    public function testValidValues($value)
    {
        $constraint = new Regex('/^[0-9]+$/');
        $this->validator->validate($value, $constraint);

        $this->assertNoViolation();
    }

    public function getValidValues()
    {
        return array(
            array(0),
            array('0'),
            array('090909'),
            array(90909),
        );
    }

    /**
     * @dataProvider getInvalidValues
     */
    public function testInvalidValues($value)
    {
        $constraint = new Regex('/^[0-9]+$/');

        $this->validator->validate($value, $constraint);
        $this->assertViolation($constraint->message);
    }

    public function getInvalidValues()
    {
        return array(
            array('abcd'),
            array('090foo'),
        );
    }

}