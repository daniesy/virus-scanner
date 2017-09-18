<?php

namespace Daniesy\VirusScanner\Result;


use Psr\Http\Message\ResponseInterface;

class VirusScannerDomainResult
{
    public function __construct(ResponseInterface $data)
    {
        $decodedData = json_decode($data->getBody()->getContents(), true);

        foreach($decodedData as $key => $value) {
            $this->$key = $value;
        }
    }
}