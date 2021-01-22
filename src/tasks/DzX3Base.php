<?php


namespace ws\utils\tasks;


use GuzzleHttp\Client;

class DzX3Base
{
    public $base_url = '';
    public $apply_url = '';
    public $draw_url = '';

    public $client;

    public function __construct($cookie)
    {
        $this->client = new Client([
            'base_url' => $this->base_url,
            'defaults' => [
                'headers' => [
                    'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36',
                    'cookie' => $cookie,
                ]
            ]
        ]);
    }

    public function run()
    {
        $this->client->get($this->apply_url);
        sleep(1);
        $this->client->get($this->draw_url);
    }
}