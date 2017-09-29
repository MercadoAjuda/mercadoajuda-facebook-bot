<?php

namespace App\Bot\Webhook;

use Illuminate\Http\Request;

class Entry
{
    private $time;
    private $id;
    private $messagings;

    /**
     * Atribui as mensagens passando pela classe \Messaging
     * 
     * @param Array $data
     * @return App\Bot\Entry
     */
    private function __construct(Array $data)
    {
        $this->id = $data["id"];
        $this->time = $data["time"];
        $this->messagings = [];

        foreach ($data["messaging"] as $message) {
            $this->messagings[] = new Messaging($message);
        }
    }

    /**
     * Recebe as mensagens e prepara para o envio
     *
     * @param Request $request
     * @return array
     */
    public static function getEntries(Request $request)
    {
        $entries = [];
        $entriesFromRequest = $request->input("entry");

        foreach ($entriesFromRequest as $entry) {
            $entries[] = new Entry($entry);
        }
        
        return $entries;
    }

    /**
     * Data da mensagem
     *
     * @return int timestamp
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * ID da mensagem
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Todas as mensagens
     *
     * @return array
     */
    public function getMessagings()
    {
        return $this->messagings;
    }
}