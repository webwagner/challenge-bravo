# <img src="https://avatars1.githubusercontent.com/u/7063040?v=4&s=200.jpg" alt="HU" width="24" /> Desafio Bravo

API constuida usando a linguagem PHP e o framework Slim.

A API converte entre as seguintes moedas:
- USD
- BRL
- EUR
- BTC
- ETH

Link para a API /{from}/{to}/{amount}
Ex: /EUR/BRL/60.00

Arquivos do framework que foram alterados:
- challenge-bravo\api-conversao-monetaria\src\dependencies.php
- challenge-bravo\api-conversao-monetaria\src\routes.php
- challenge-bravo\api-conversao-monetaria\composer.json
- challenge-bravo\api-conversao-monetaria\public\index.php

Arquivos que foram criados por mim:
- challenge-bravo\api-conversao-monetaria\src\Action\HomeAction.php
- challenge-bravo\api-conversao-monetaria\src\Service\ConvertCurrency.php
- challenge-bravo\api-conversao-monetaria\tests\Functional\HomeActionTest.php
- challenge-bravo\api-conversao-monetaria\tests\Functional\ConvertCurrencyTest.php

Para iniciar a API no diretório challenge-bravo\api-conversao-monetaria\ executar o comando:
- php -S localhost:8080 -t public public/index.php

Para rodar os testes no diretório challenge-bravo\api-conversao-monetaria\vendor\bin\ executar os comandos:
- phpunit ../../tests/Functional/ConvertCurrencyTest.php
- phpunit ../../tests/Functional/HomeActionTest.php