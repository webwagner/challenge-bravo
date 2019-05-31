<?php

namespace Tests\Functional;

class HomeActionTest extends BaseTestCase
{
    /**
     * Testa se a rota retorna página não encontrada quando não passa parâmetros
     */
    public function testGetHomeactionWithoutParameters()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Página não encontrada. Formato da url deve ser /from/to/amount. Ex: BTC/EUR/123.45', (string)$response->getBody());
    }

    /**
     * Testa se a rota retorna o resultado esperado quando passado os parâmetros /EUR/BRL/60
     */
    public function testGetHomeactionWithParameters()
    {
        $response = $this->runApp('GET', '/EUR/BRL/60');

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertContains((string)$response->getBody(), '{"result":"BRL 264,00"}');
    }

    /**
     * Testa se a rota retorna página não encontrada quando enviado por post
     */
    public function testPostHomeactionNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Página não encontrada. Formato da url deve ser /from/to/amount. Ex: BTC/EUR/123.45', (string)$response->getBody());
    }
}
