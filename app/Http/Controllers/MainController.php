<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Bot\Webhook\Entry;
use App\Jobs\BotHandler;

class MainController extends Controller
{
    /**
     * Recebe a mensagem
     * Realiza a formatação através das classes 
     * Faz o dispatch para o job enviar a resposta
     * 
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function receive(Request $request)
    {
        $entries = Entry::getEntries($request);
        
        foreach ($entries as $entry) {
            $messagings = $entry->getMessagings();

            foreach ($messagings as $messaging) {
                dispatch(new BotHandler($messaging));
            }
        }
        
        return response("", 200);
    }
}
