<?php
namespace Kaizen\AwsAgent\DynamoDb;

interface DynamoDbClientInterface
{
    public function putItem(array $args);
    public function getItem(array $args);
    public function deleteItem(array $args);
    public function updateItem(array $args);
}
