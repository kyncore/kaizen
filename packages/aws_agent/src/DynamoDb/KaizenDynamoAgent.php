<?php

namespace Kaizen\AwsAgent\DynamoDb;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

class KaizenDynamoAgent
{
    private DynamoDbClientInterface $client;
    // private DynamoDbClient $client;
    private string $tableName;
    private Marshaler $marshaler;

    // public function __construct(array $config, string $tableName)
    // public function __construct($awsKey, $awsSecret, $region = 'ap-northeast-1', ?DynamoDbClient $client = null)
    // {
    //     if ($client) {
    //         $this->client = $client;
    //     } else {
    //         $this->client = new DynamoDbClient([
    //             'region' => $region,
    //             'version' => 'latest',
    //             'credentials' => [
    //                 'key' => $awsKey,
    //                 'secret' => $awsSecret,
    //             ],
    //         ]);
    //     }
    //     $this->marshaler = new Marshaler();
    // }
    public function __construct(DynamoDbClientInterface $client)
    {
        $this->client = $client;
        $this->marshaler = new Marshaler();
    }

    public function putItem($tableName, array $item): void
    {
        $this->client->putItem([
            'TableName' => $tableName,
            'Item' => $this->marshal($item),
        ]);
    }

    public function getItem($tableName, array $key): ?array
    {
        $result = $this->client->getItem([
            'TableName' => $tableName,
            'Key' => $this->marshal($key),
        ]);

        if (!isset($result['Item'])) {
            return null;
        }

        return $this->unmarshal($result['Item']);
    }

    public function deleteItem($tableName, array $key): void
    {
        $this->client->deleteItem([
            'TableName' => $tableName,
            'Key' => $this->marshal($key),
        ]);
    }

    public function updateItem($tableName, array $key, array $updates): void
    {
        $expression = [];
        $expressionValues = [];
        $attributeNames = [];

        foreach ($updates as $k => $v) {
            $expression[] = "#$k = :$k";
            $expressionValues[":$k"] = $this->marshalValue($v);
            $attributeNames["#$k"] = $k;
        }

        $this->client->updateItem([
            'TableName' => $tableName,
            'Key' => $this->marshal($key),
            'UpdateExpression' => 'SET ' . implode(', ', $expression),
            'ExpressionAttributeValues' => $expressionValues,
            'ExpressionAttributeNames' => $attributeNames,
        ]);
    }

    private function marshal(array $data): array
    {
        return $this->marshaler->marshalItem($data);
    }

    private function unmarshal(array $data): array
    {
        return $this->marshaler->unmarshalItem($data);
    }

    private function marshalValue($value): array
    {
        return $this->marshaler->marshalValue($value);
    }
}
