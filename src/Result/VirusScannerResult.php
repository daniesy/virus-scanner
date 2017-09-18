<?php

namespace Daniesy\VirusScanner\Result;


class VirusScannerResult extends Result
{
    public $positives = 0;
    public $total = 0;
    public $permalink = "";
    public $scans = [];

    public function __construct($data)
    {
        if($data['response_code'] == 1) {
            parent::__construct($data);
        }
    }

    /**
     * @return bool
     */
    public function isClean() : bool
    {
        return $this->positives == 0;
    }

}