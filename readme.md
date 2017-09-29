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
- Adiciona a mensagem nos queue jobs do Laravel
- Retorna um 200

- [Laravel Queues](https://laravel.com/docs/5.4/queues)

---------
###### Hospedado no heroku com deploy automático.