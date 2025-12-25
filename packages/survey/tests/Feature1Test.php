<?php
namespace Kaizen\Feature1\Tests;

use Kaizen\Feature1\Feature1;
use PHPUnit\Framework\TestCase;

class Feature1Test extends TestCase
{
    public function testDoSomething()
    {
        $feature = new Feature1();
        $this->assertStringContainsString('Feature1 using kaizen Core Client', $feature->doSomething());
    }
}
