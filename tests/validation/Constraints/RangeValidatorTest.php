<?php
declare(strict_types=1);
use App\Validation\Constraints\RangeValidator;
use App\Validation\Constraints\Range;

class RangeValidatorTest extends ConstraintValidatorTest
{
    protected function createValidator()
    {
        return new RangeValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Range(10, 20));

        $this->assertNoViolation();
    }

    public function getTenToTwenty()
    {
        return array(
            array(10.00001),
            array(19.99999),
            array('10.00001'),
            array('19.99999'),
            array(10),
            array(20),
            array(10.0),
            array(20.0),
        );
    }

    public function getLessThanTen()
    {
        return array(
            array(9.99999, '9.99999'),
            array('9.99999', '"9.99999"'),
            array(5, '5'),
            array(1.0, '1.0'),
        );
    }

    public function getMoreThanTwenty()
    {
        return array(
            array(20.000001, '20.000001'),
            array('20.000001', '"20.000001"'),
            array(21, '21'),
            array(30.0, '30.0'),
        );
    }

    /**
     * @dataProvider getTenToTwenty
     */
    public function testValidValuesMinMax($value)
    {
        $constraint = new Range(10, 20);
        $this->validator->validate($value, $constraint);

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getMoreThanTwenty
     */
    public function testTooBigValuesMinMax($value)
    {
        $constraint = new Range(10, 20);
        $this->validator->validate($value, $constraint);

        $this->assertViolation(sprintf($constraint->maxMessage, 20));
    }

    /**
     * @dataProvider getLessThanTen
     */
    public function testTooSmallValuesMinMax($value)
    {
        $constraint = new Range(10, 20);
        $this->validator->validate($value, $constraint);

        $this->assertViolation(sprintf($constraint->minMessage, 10));
    }

    /**
     * @dataProvider getTenToTwenty
     */
    public function testValidValuesMax($value)
    {
        $constraint = new Range(null, 20);
        $this->validator->validate($value, $constraint);

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getMoreThanTwenty
     */
    public function testTooBigValuesMax($value)
    {
        $constraint = new Range(null, 20);
        $this->validator->validate($value, $constraint);

        $this->assertViolation(sprintf($constraint->maxMessage, 20));
    }

    /**
     * @dataProvider getTenToTwenty
     */
    public function testValidValuesMin($value)
    {
        $constraint = new Range(10, null);
        $this->validator->validate($value, $constraint);

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getLessThanTen
     */
    public function testTooSmallValuesMin($value)
    {
        $constraint = new Range(10, null);
        $this->validator->validate($value, $constraint);

        $this->assertViolation(sprintf($constraint->minMessage, 10));
    }
}
