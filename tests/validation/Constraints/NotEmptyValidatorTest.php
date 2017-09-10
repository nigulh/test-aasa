<?php
declare(strict_types=1);

class NotEmptyValidatorTest extends ConstraintValidatorTest
{
    protected function createValidator()
    {
        return new \App\Validation\Constraints\NotEmptyValidator();
    }

    public function getEmpty() {
        return array(array(""), array(null));
    }

    /**
     * @dataProvider getEmpty
     */
    public function testEmptyStringIsInvalid($value)
    {
        $constraint = new \App\Validation\Constraints\NotEmpty();
        $this->validator->validate($value, $constraint);

        $this->assertViolation($constraint->message);
    }

    public function testValueIsValid() {
        $this->validator->validate('foo', new \App\Validation\Constraints\NotEmpty());

        $this->assertNoViolation();
    }
}
