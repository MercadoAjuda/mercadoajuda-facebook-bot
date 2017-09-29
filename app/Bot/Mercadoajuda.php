<?php

namespace App\Bot;

use Illuminate\Support\Facades\Cache;

class Mercadoajuda
{
    public static $START = "start";
    public static $PRICINGS = "pricings";
    public static $DEMO = "demo";
    public static $TEMPLATES = "templates";

    private $response;

    /**
     * __construct
     *
     * @param string $data
     */
    public function __construct($data)
    {
        $this->response = $data;
    }

    public static function getStart()
    {
        $start = "Olá, eu sou o bot do MercadoAjuda.\n";
        $start.= "Me pergunte algo ou use o menu ao lado do chat para ver as opções disponíveis.\n";

        return new Mercadoajuda($start);
    }

    public static function getPricings()
    {
        $pricings = "Veja, possuímos os seguintes planos\n\n";
        $pricings.= "Plano Grátis\n";
        $pricings.= "Plano Médio - R$ 29,00/mês\n";
        $pricings.= "Plano Completo - R$ 39,00/mês\n\n";
        $pricings.= "Quer saber mais sobre os planos?\nhttps://mercadoajuda.com.br/precos-e-planos";

        return new Mercadoajuda($pricings);
    }

    public static function getDemo()
    {
        $demo = "Veja nosso vídeo de demonstração\n";
        $demo.= "Lá mostra o funcionamento completo da ferramenta!\n";
        $demo.= "https://www.youtube.com/watch?v=HsBKRbpJsSQ";

        return new Mercadoajuda($demo);
    }

    public static function getTemplates()
    {
        $templates = "Nós também desenvolvemos tamplates exclusivos!\n\n";
        $templates.= "https://mercadoajuda.com.br/templates-profissionais";

        return new Mercadoajuda($templates);
    }

    public function toMessage()
    {
        return ["text" => $this->response];
    }
}