# saxulum-http-client-adapter-buzz

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-http-client-adapter-buzz.png?branch=master)](https://travis-ci.org/saxulum/saxulum-http-client-adapter-buzz)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-http-client-adapter-buzz/downloads.png)](https://packagist.org/packages/saxulum/saxulum-http-client-adapter-buzz)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-http-client-adapter-buzz/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-http-client-adapter-buzz)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-http-client-adapter-buzz/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/saxulum/saxulum-http-client-adapter-buzz/?branch=master)

## Features

 * Provides a http client interface adapter for [buzz][1]

## Requirements

 * PHP 5.3+

## Installation

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-http-client-adapter-buzz][2].

## Usage

``` {.php}
use Saxulum\HttpClient\Buzz\HttpClient;
use Saxulum\HttpClient\Request;

$httpClient = new HttpClient();
$response = $httpClient->request(new Request(
    '1.1',
    Request::METHOD_GET,
    'http://www.wikipedia.org',
    array(
        'Connection' => 'close',
    )
));
```

You can inject your own buzz browser instance while creating the http client instance.

``` {.php}
use Buzz\Browser;
use Saxulum\HttpClient\Buzz\HttpClient;

$browser = new Browser;
$httpClient = new HttpClient($browser);
```

[1]: https://packagist.org/packages/kriswallsmith/buzz
[2]: https://packagist.org/packages/saxulum/saxulum-http-client-adapter-buzz