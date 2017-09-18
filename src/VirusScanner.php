<?php

namespace Daniesy\VirusScanner;


use Daniesy\VirusScanner\Result\VirusScannerDomainResult;
use Daniesy\VirusScanner\Result\VirusScannerIpResult;
use Daniesy\VirusScanner\Result\VirusScannerResult;
use VirusTotal\Domain;
use VirusTotal\Ip;
use VirusTotal\Url;

class VirusScanner
{
    private $scanJob = null;
    /**
     * @var string
     */
    private $resource = "";

    private function apiKey() : string {
        return config('virus_scanner.api_key');
    }

    /**
     * @param string $path
     * @param bool $rescan
     * @return VirusScanner
     */
    public function scanFile(string $path, bool $rescan = false) : VirusScanner
    {
        $this->scanJob = new \VirusTotal\File($this->apiKey());
        $this->resource = $this->scanJob->scan($path)['resource'];

        if($rescan) {
            $this->scanJob->rescan($this->resource);
        }

        return $this;
    }

    /**
     * @param string $url
     * @return VirusScanner
     */
    public function scanUrl(string $url) : VirusScanner
    {
        $this->scanJob = new Url($this->apiKey());
        $this->scanJob->scan($url);
        $this->resource = $url;
        return $this;
    }

    /**
     * @param float $refreshInterval
     * @return VirusScannerResult
     */
    public function checkResult(float $refreshInterval = 1.0) : VirusScannerResult
    {
        $reportData = $this->scanJob->getReport($this->resource);

        if($reportData["response_code"] == 0) {
            sleep($refreshInterval);
            return $this->checkResult($refreshInterval);
        }

        return new VirusScannerResult($reportData);
    }

    /**
     * @param $ip
     * @return VirusScannerIpResult
     */
    public function checkIp($ip) : VirusScannerIpResult
    {
        $scan = new Ip($this->apiKey());
        return new VirusScannerIpResult($scan->getReport($ip));
    }

    /**
     * @param $domain
     * @return VirusScannerDomainResult
     */
    public function checkDomain($domain) : VirusScannerDomainResult
    {
        $scan = new Domain($this->apiKey());
        return new VirusScannerDomainResult($scan->getReport($domain));
    }
}
