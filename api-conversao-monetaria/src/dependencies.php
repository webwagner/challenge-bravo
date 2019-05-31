<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
    
    // Page not found
    $container['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $response->withStatus(404)
                ->withHeader('Content-Type', 'text/html')
                ->write('Página não encontrada. Formato da url deve ser /from/to/amount. Ex: BTC/EUR/123.45');
        };
    };

    // Inseri a dependência do logger na HomeAction
    $container[Src\Action\HomeAction::class] = function ($c) {
        return new Src\Action\HomeAction($c->get('logger'));
    };
};
