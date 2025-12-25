<?php
namespace Kaizen\Feature2;

use Kaizen\Core\Client;

class Feature2
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function doSomethingElse(): string
    {
        return "Feature2 using " . $this->client->getClientName();
    }
}
