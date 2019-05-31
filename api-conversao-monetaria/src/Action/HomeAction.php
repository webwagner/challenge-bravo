<?php
namespace Src\Action;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Src\Service\ConvertCurrency;

class HomeAction
{
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function __invoke(Request $request, Response $response, $args)
    {
        $time = microtime(true);
                
        $convertCurrency = new ConvertCurrency();
        $convertCurrency->setTo($args['to']);
        $convertCurrency->setFrom($args['from']);
        $convertCurrency->setAmount($args['amount']);
        $data = $convertCurrency->convert();
        
        //Guarda o tempo de processamento em um arquivo de log
        $this->logger->info("Request processada em ".(microtime(true) - $time));
        
        return $response->withJson($data, (isset($data['erro']) ? 400 : 200));
    }
}