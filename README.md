# Laravel Virus Scanner
A simple and updated Virus Total wrapper for Laravel 5.5+


## Info

 This package is designed to be used with Laravel 5.5, but you can use it as a standalone package too.

**Laravel Virus Scanner** provides a service provider and a facade, but thanks to Laravel's package auto-discovery, you DON'T need to edit `app.php`. :)


## Instalation

Get starting in 3 easy steps:

1. Install package: `composer require daniesy/virus-scanner`
2. Publish vendor settings: `php artisan vendor:publish`
3. Set your api_key in the `config/virus_scanner.php`


## Usage

**Laravel Virus Scanner** implements all the features offered by the [Virus Total Api](https://www.virustotal.com/en/documentation/public-api/#getting-url-scans).

### Scan a file

The scan process can take some time because the files scanned through the Virus Total Api are handled with the lowest priority.

    use VirusScanner;

    $scanner = VirusScanner::scanFile('/path/to/file');
    $result = $scanner->checkResult();

    echo $result->total;         // The total number of scans
    echo $result->positives;     // The number of positive detections
    echo $result->permalink;     // Url of the scan page
    var_dump($result->scans);    // Array of results for each individual scan


### Scan an url

    use VirusScanner;

    $scanner = VirusScanner::scanUrl('http://url/to/file.exe');
    $result = $scanner->checkResult();


### Check a domain

    use VirusScanner;

    $report = VirusScanner::checkDomain("https://danutflorian.com");
    var_dump($report);

### Check an ip

    use VirusScanner;

    $report = VirusScanner::checkIp('192.168.1.1');
    var_dump($report);
