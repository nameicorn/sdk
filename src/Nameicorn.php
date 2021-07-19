<?php

/*
 * (c) Nameicorn <nameicorn@develop.scot>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Nameicorn\Nameicorn;

use GuzzleHttp\Client as HttpClient;

class Nameicorn
{
    use MakesHttpRequests;

    /**
     * Nameicorn API key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Guzzle HTTP Client instance
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

    /**
     * Number of seconds a request is retried
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * Create a Nameicorn Instance
     *
     * @param null $apiKey
     * @param HttpClient|null $guzzle
     */
    public function __construct($apiKey = null, HttpClient $guzzle = null)
    {
        if (! is_null($apiKey)) {
            $this->setApiKey($apiKey, $guzzle);
        }

        if (! is_null($guzzle)) {
            $this->guzzle = $guzzle;
        }
    }

    /**
     * Set API key and setup Guzzle request object.
     *
     * @param $apiKey
     * @param null $guzzle
     * @return $this
     */
    public function setApiKey($apiKey, $guzzle = null)
    {
        $this->apiKey = $apiKey;

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_url' => 'https://nameicorn.com/api/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Set a new timeout.
     *
     * @param  int  $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
}