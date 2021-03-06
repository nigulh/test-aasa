<?php

use App\Validation\ValidationContext;

abstract class ConstraintValidatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ValidationContext
     */
    protected $context;
    /**
     * @var ConstraintValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->context = new ValidationContext();
        $this->validator = $this->createValidator();
        $this->validator->initialize($this->context);
    }

    protected function assertNoViolation()
    {
        $this->assertSame(0, $violationsCount = count($this->context->GetViolations()), sprintf('0 violation expected. Got %u.', $violationsCount));
    }

    protected function assertViolation($message)
    {
        $this->assertSame(1, $violationsCount = count($this->context->GetViolations()), sprintf('1 violation expected. Got %u.', $violationsCount));
        $this->assertSame($message, $gotMessage = $this->context->GetViolations()[0], sprintf('Expected violation %s, got %s', $message, $gotMessage));
    }

    /**
     * @return ConstraintValidator
     */
    protected abstract function createValidator();
}