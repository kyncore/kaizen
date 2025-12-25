<?php
namespace Kaizen\Survey;

use Kaizen\Core\Client;

class Survey
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function doSomething(): string
    {
        return "Survey using " . $this->client->getClientName();
    }
}
