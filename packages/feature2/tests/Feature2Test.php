<?php
namespace Kaizen\Feature2\Tests;

use Kaizen\Feature2\Feature2;
use PHPUnit\Framework\TestCase;

class Feature2Test extends TestCase
{
    public function testDoSomethingElse()
    {
        $feature = new Feature2();
        $this->assertStringContainsString('Feature2 using kaizen Core Client', $feature->doSomethingElse());
    }
}
