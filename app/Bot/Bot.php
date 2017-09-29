<?php

namespace App\Bot;

use Illuminate\Support\Facades\Log;

use App\Bot\Webhook\Messaging;

class Bot
{
    private $messaging;

    /**
     * Messaging
     * 
     * @param App\Bot\Webhook\Messaging $messaging
     * @return void
     */
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Realiza a verificação do tipo de mensagem
     *
     * @return void
     */
    public function extractDataFromMessage()
    {
        $matches = [];

        if ($this->messaging->getType() == 'message') {
            $text = $this->messaging->getMessage()->getText();
        } else if ($this->messaging->getType() == 'postback') {
            $text = $this->messaging->getMessage()->getPayload();
        }

        if (preg_match("/(?=.*comecar|sample_get_started_payload|start)(.+)/i", $text, $matches)) {
            return [
                "type" => Mercadoajuda::$START,
            ];
        } else if (preg_match("/(?=.*plano|pricing|oferta|preço|preco|valor)(.+)/i", $text, $matches)) {
            return [
                "type" => Mercadoajuda::$PRICINGS,
            ];
        } else if (preg_match("/(?=.*demo|demonstra|video|como funciona|como usar)(.+)/i", $text, $matches)) {
            return [
                "type" => Mercadoajuda::$DEMO,
            ];
        } else if (preg_match("/(?=.*template|descricao|anuncio)(.+)/i", $text, $matches)) {
            return [
                "type" => Mercadoajuda::$TEMPLATES,
            ];
        }

        return [
            "type" => "unknown",
        ];
    }

    /**
     * Monta a resposta
     *
     * @param string|App\Bot $data
     * @return void
     */
    public function reply($data)
    {
        if (method_exists($data, "toMessage")) {
            $data = $data->toMessage();
        } else if (gettype($data) == "string") {
            $data = ["text" => $data];
        }

        $id = $this->messaging->getSenderId();
        
        $this->sendMessage($id, $data);
    }

    /**
     * Realiza o envio da resposta
     *
     * @param int $recipientId
     * @param string $message
     * @return void
     */
    private function sendMessage($recipientId, $message)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => $message
        ];
        
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
    }
}