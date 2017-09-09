<?php
declare(strict_types=1);
namespace Tests;

use PHPUnit\Framework\TestCase;

final class SampleTest extends TestCase
{
    public function testCanTest(): void
    {
        $this->assertTrue(true, "This one succeeds");
        //$this->assertTrue(false, "This one fails");
    }
}