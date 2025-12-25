<?php
namespace Kaizen\Core\Tests;

use Kaizen\Core\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testGetClientName()
    {
        $client = new Client();
        $this->assertSame('kaizen Core Client', $client->getClientName());
    }
}
