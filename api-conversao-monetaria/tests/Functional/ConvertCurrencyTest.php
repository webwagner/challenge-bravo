<?php

namespace Tests\Functional;
use Src\Service\ConvertCurrency;

class ConvertCurrencyTest extends BaseTestCase
{
    protected $convertCurrency;
    
    public function setUp()
    {
        $this->convertCurrency = new ConvertCurrency();
    }
    
    /**
     * Testa se a função retorna o valor correto para conversão
     */
    public function testConvert()
    {
        $this->convertCurrency->setAmount('60.00');
        $this->convertCurrency->setFrom('EUR');
        $this->convertCurrency->setTo('BRL');
        
        $this->assertContains('BRL 264,00', $this->convertCurrency->convert()['result']);
    }
    
    /**
     * Testa se a função valida um parâmetro inválido para from
     */
    public function testConvertInvalidFrom()
    {
        $this->convertCurrency->setAmount('60.00');
        $this->convertCurrency->setFrom('XXX');
        $this->convertCurrency->setTo('BRL');
        
        $this->assertContains('Moeda XXX não existe. Moedas disponiveis: USD,BRL,EUR,BTC,ETH', $this->convertCurrency->convert()['error']);
    }
    
    /**
     * Testa se a função valida um parâmetro inválido para to
     */
    public function testConvertInvalidTo()
    {
        $this->convertCurrency->setAmount('60.00');
        $this->convertCurrency->setFrom('BRL');
        $this->convertCurrency->setTo('XXX');
        
        $this->assertContains('Moeda XXX não existe. Moedas disponiveis: USD,BRL,EUR,BTC,ETH', $this->convertCurrency->convert()['error']);
    }
    
    /**
     * Testa se a função valida um parâmetro inválido para amount
     */
    public function testConvertInvalidAmount()
    {
        $this->convertCurrency->setAmount('XXX');
        $this->convertCurrency->setFrom('BRL');
        $this->convertCurrency->setTo('EUR');
        
        $this->assertContains('Valor XXX não é válido.', $this->convertCurrency->convert()['error']);
    }
}