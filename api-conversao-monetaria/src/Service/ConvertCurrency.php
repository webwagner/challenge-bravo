<?php
namespace Src\Service;

/**
 * Convert Currency Class
 * @author Wagner Ramos 
 * @version 1.0
*/
class ConvertCurrency
{
    /**
     * @var array $currency
     */
    private static $currency = array('USD' => 1,'BRL' => 3.96,'EUR' => 0.90,'BTC' => 0.00012,'ETH' => 0.0037);
   
    /**
     * @var string $to
     */
    private $to;
    
    /**
     * @var string $from
     */
    private $from;
    
    /**
     * @var float $amount
     */
    private $amount;
    
    /**
     * Return To
     * @return string
     */
    public function getTo() 
    {
        return $this->to;
    }

    /**
     * Return From
     * @return string
     */
    public function getFrom() 
    {
        return $this->from;
    }

    /**
     * Return Amount
     * @return float
     */
    public function getAmount() 
    {
        return $this->amount;
    }
    
    /**
     * Set To
     * @param string
     */
    public function setTo($to) 
    {
        $this->to = $to;
    }

    /**
     * Set From
     * @param string
     */
    public function setFrom($from) 
    {
        $this->from = $from;
    }

    /**
     * Set Amount
     * @param float
     */
    public function setAmount($amount) 
    {
        $this->amount = $amount;
    }
    
    /**
     * Validate To
     * @param string
     * @return string
     */
    private function getCurrencyTo($to)
    {
        if (!isset(self::$currency[$to])) {
            throw new \Exception('Moeda '.$to.' não existe. Moedas disponiveis: '. implode(',',array_keys(self::$currency)));
        }
        
        return self::$currency[$to];
    }

    /**
     * Validate From
     * @param string
     * @return string
     */
    private function getCurrencyFrom($from)
    {
        if (!isset(self::$currency[$from])) {
            throw new \Exception('Moeda '.$from.' não existe. Moedas disponiveis: '. implode(',',array_keys(self::$currency)));
        }
        
        return self::$currency[$from];
    }
    
    /**
     * Validate Amount
     * @param float
     * @return float/String
     */
    private function validateAmount($amount)
    {
        if(!preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $amount)){
            throw new \Exception('Valor '.$amount.' não é válido.');
        }
        
        return $amount;
    }

    /**
     * Convert Currency
     * @return array
     */
    public function convert()
    {        
        try{
            $to = $this->getCurrencyTo($this->getTo());
            $from = $this->getCurrencyFrom($this->getFrom());
            $amount = $this->validateAmount($this->getAmount());
            
            $factor = ($to / $from);
            $value = ($amount * $factor);

            $data['result'] = $this->getTo().' '.number_format($value, 2, ',', '.');
            return $data;
        } catch (\Exception $ex) {
            $data['error'] = $ex->getMessage();
            return $data;
        }
    }
}