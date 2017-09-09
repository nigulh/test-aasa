<?php
declare(strict_types=1);

use App\Validation\ValidationContext;
use PHPUnit\Framework\TestCase;

class ValidationContextTest extends TestCase
{
    public function testCanAddViolation(): void
    {
        $validator = new ValidationContext();
        $validator->SetCurrentFieldName("foo");
        $validator->AddViolation("bar");
        $this->assertEquals(array("foo" => array("bar")), $validator->GetFieldViolations());
    }
}
