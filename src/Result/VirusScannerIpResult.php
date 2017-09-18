<?php

namespace Daniesy\VirusScanner\Result;


use Psr\Http\Message\ResponseInterface;

class VirusScannerIpResult extends Result
{
    public $asn;

    public $undetected_downloaded_samples;
    public $country;
    public $response_code;
    public $as_owner;
    public $verbose_msg;

    public $resolutions = [];
    public $detected_urls = [];

    public function __construct(ResponseInterface $data)
    {
        $decodedData = json_decode($data->getBody()->getContents(), true);
        parent::__construct($decodedData);
    }
}