<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Bot\Bot;
use App\Bot\Mercadoajuda;
use App\Bot\Webhook\Messaging;

class BotHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messaging;

    /**
     * Recebe a mensagem para conseguir manter o ID do usuário para responde-lo
     *
     * @param App\Bot\Webhook\Messaging $messaging
     * @return void
     */
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Execute the job.
     *
     * @param Messaging $messaging
     * @return void
     */
    public function handle()
    {
        $bot = new Bot($this->messaging);
        $custom = $bot->extractDataFromMessage();

        if ($custom["type"] == Mercadoajuda::$START) {
            $bot->reply(Mercadoajuda::getStart());
        } else if ($custom["type"] == Mercadoajuda::$PRICINGS) {
            $bot->reply(Mercadoajuda::getPricings());
        } else if ($custom["type"] == Mercadoajuda::$DEMO) {
            $bot->reply(Mercadoajuda::getDemo());
        } else if ($custom["type"] == Mercadoajuda::$TEMPLATES) {
            $bot->reply(Mercadoajuda::getTemplates());
        } else {
            $bot->reply("Desculpe. Não consegui entender. Entre em contato através do email: contato@mercadoajuda.com.br");
        }
    }
}