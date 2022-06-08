<?php
require_once 'Requests.php';

class TelegramRequests
{
    private Requests $requests;

    function __construct(private string $botToken)
    {
        $this->requests = new Requests();
    }

    function api_request($method, $params = array()): bool|string
    {
        $url = 'http://localhost:8081/bot' . $this->botToken . '/' . $method;
        return $this->requests->post($url, $data = $params);
    }
}

