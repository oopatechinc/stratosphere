<?php

namespace App\Abstracts;

use App\Contracts\VideoConferenceServiceContract;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractVideoConferenceService implements VideoConferenceServiceContract
{
    protected Client $client;
    protected array $headers = [];
    protected ResponseInterface $response;

    public function __construct(array $headers, Client $client)
    {
        $this->headers = $headers;
        $this->client = $client;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse() : ResponseInterface
    {
        return $this->response;
    }

    public function getJsonEncodedResponse() : mixed
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }
}
