<?php

namespace App\Services;

use App\Support\Currency\Client;

class CurrencyService extends Client
{
    private Client $client;

    private string $data;

    public function __construct (Client $client)
    {
        $this->client = $client;
    }

    public function setData(string $endpoint): CurrencyService
    {
        $this->data = $this->client->request('GET', $endpoint)->getBody()->getContents();

        return $this;
    }

    /**
     * @return  array<mixed,mixed>
     */
    public function toJson()
    {
        return json_decode($this->data);
    }
}