<?php

namespace App\Bot\Webhook;

class Postback
{
    private $payload;
    private $title;

    /**
     * __construct
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
         $this->payload = isset($data["payload"]) ? $data["payload"] : "";
         $this->title = isset($data["title"]) ? $data["title"] : "";
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getTitle()
    {
        return $this->title;
    }
}