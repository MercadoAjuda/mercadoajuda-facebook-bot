# MercadoAjuda - Facebook Bot

### Projeto criado com o intuito de estudar chatbots

[Página no Facebook](https://www.facebook.com/appmercadoajuda/)
---------
[Site MercadoAjuda](https://mercadoajuda.com.br/)

#### Rodando o projeto
```
composer install
edit .env
php artisan migrate
php artisan serve
```

#### Fluxo de mensagem

- Usuário manda uma pergunta através do chat
- Aplicação recebe um POST
- Adiciona a mensagem nos queue jobs do Laravel para que seja respondida depois
- Retorna um 200

Na documentação o Facebook diz que é de extrema importância o retorno de um código HTTP 200 assim que eles enviam um POST.
Por este motivo se torna necessário adicionar na fila as mensagens recebidas, retornar o código 200 e depois processá-las.
O processamento da fila não demora muito tempo então praticamente o usuário não percebe.

- [Laravel Queues](https://laravel.com/docs/5.4/queues)

Chat: 
![](https://app.mercadoajuda.com.br/img/gif-chatbot.gif)

---------