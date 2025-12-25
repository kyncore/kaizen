<?php
namespace Kaizen\AwsAgent\DynamoDb;

use Aws\DynamoDb\DynamoDbClient as AwsDynamoDbClient;

class AwsDynamoDbClientWrapper implements DynamoDbClientInterface
{
    private AwsDynamoDbClient $client;

    public function __construct(AwsDynamoDbClient $client)
    {
        $this->client = $client;
    }

    public function putItem(array $args)
    {
        return $this->client->putItem($args);
    }

    public function getItem(array $args)
    {
        return $this->client->getItem($args);
    }

    public function deleteItem(array $args)
    {
        return $this->client->deleteItem($args);
    }

    public function updateItem(array $args)
    {
        return $this->client->updateItem($args);
    }
}
