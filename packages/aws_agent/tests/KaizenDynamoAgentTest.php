<?php
namespace Kaizen\AwsAgent\DDynamoDb\Tests;

use Kaizen\AwsAgent\DynamoDb\DynamoDbClientInterface;
use Kaizen\AwsAgent\DynamoDb\KaizenDynamoAgent;
use PHPUnit\Framework\TestCase;

class KaizenDynamoAgentTest extends TestCase
{
    public function testPutItemCallsAwsClient()
    {
        $mockClient = $this->createMock(DynamoDbClientInterface::class);

        $mockClient->expects($this->once())
            ->method('putItem')
            ->with($this->callback(function ($params) {
                return isset($params['TableName']) && isset($params['Item']);
            }));

        $agent = new KaizenDynamoAgent($mockClient);
        $agent->putItem('TestTable', ['id' => '123', 'name' => 'Alice']);
    }
}
