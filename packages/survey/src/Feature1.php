<?php
namespace Kaizen\Feature1;

use Kaizen\Core\Client;

class Feature1
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function doSomething(): string
    {
        return "Feature1 using " . $this->client->getClientName();
    }
}
