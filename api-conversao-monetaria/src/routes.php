<?php

use Slim\App;

return function (App $app)
{
    /**
    * Convert Currency
    *
    * @link /:from/:to/:amount
    *
    */
    $app->get('/{from}/{to}/{amount}', Src\Action\HomeAction::class)->setName('homeaction');
};
