## Como instalar e rodar o projeto

1. ```git clone https://github.com/BernanR/backend-php-test.git```
2. ```cd application```
3. ```composer install```
3. Copy ```.env.example``` to ```.env```
4. ```docker-compose build```
5. ```docker compose up -d```
6. disponível na url ```127.0.0.1:8080```


## Rodar migrates e seeds

1. ```docker-compose exec app.dev php artisan migrate```
2. ```docker-compose exec app.dev php artisan db:seed```


## Rodar os testes

1. ```docker compose exec app.dev php artisan test```

## O que é testado
✓ Testa estrutura json no retorno de consulta de produtos<br />
✓ Testa cadastro de produtos<br />
✓ Testa se esta repeitando a regra onde o código do produto deve ser único<br />
✓ Testa o update do produto<br />
✓ Testa a exclusão de um produto<br />
✓ Testa se o esta removendo mascaras do preço do produto<br />
✓ Testa se esta retornando erro preço informado não válido<br />
✓ Testa retorno correto para exclusão de produtos que não existe<br />

## Link da Aplicação no postaman
Obs: Também foi adicionado a collection do postman na raiz do repositório.<br />
(https://www.postman.com/red-star-7529/workspace/redeancora-teste-laravel)

## O que foi feito neste projeto.

 - desenvolvimento das API's nos padrões RESTful.
 - implementação de testes utilizando phpunit

## Link Collection  API's
