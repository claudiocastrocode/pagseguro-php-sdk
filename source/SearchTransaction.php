<?php
namespace Sounoob\pagseguro;

use Sounoob\pagseguro\core\PagSeguro;
use InvalidArgumentException;

class SearchTransaction extends PagSeguro
{
    private $seguiment = array(
        'v2' => 'v2/transactions/',
        'v3' => 'v3/transactions/',
    );
    private $version = null;

    public function __construct($version = 'v3')
    {
        parent::__construct();
        $this->setVersion($version);
    }

    public function setReference($data)
    {
        $this->get['reference'] = $data;
    }

    public function setFinalDate($data)
    {
        $this->get['finalDate'] = $data;
    }
    public function setInitialDate($data)
    {
        $this->get['initialDate'] = $data;
    }

    public function setVersion($version)
    {
        if (!isset($this->seguiment[$version])) {
            throw new InvalidArgumentException('invalid API version: ' . $this->version);
        }
        $this->version = $version;
    }

    public function send()
    {
        $this->url = $this->seguiment[$this->version];
        return parent::send();
    }
}