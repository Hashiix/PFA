<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAnime($id): array
    {

        $response = $this->client->request(
            'GET',
            'https://api.jikan.moe/v3/anime/' . $id
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }

    public function getTopanime(): array
    {

        $response = $this->client->request(
            'GET',
            'https://api.jikan.moe/v3/top/anime//'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }

    public function getWeekanime(): array
    {

        $response = $this->client->request(
            'GET',
            'https://api.jikan.moe/v3/schedule/'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }

    public function getUpcoming(): array
    {

        $response = $this->client->request(
            'GET',
            'https://api.jikan.moe/v3/season/later'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }
}