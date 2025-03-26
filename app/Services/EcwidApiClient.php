<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class EcwidApiClient
 * Handles API requests to Ecwid
 *
 * @package App\Services
 */
class EcwidApiClient
{
    /**
     * The Ecwid API base URL
     *
     * @var string
     */
    private string $baseUrl;

    /**
     * The access token for authentication
     *
     * @var string
     */
    private string $accessToken;

    /**
     * The HTTP client
     *
     * @var Client
     */
    private Client $client;

    /**
     * EcwidApiClient constructor.
     *
     */
    public function __construct()
    {
        $this->accessToken = config('ecwid.access_token');
        $this->baseUrl = config('ecwid.api_base_url');
        $this->client = new Client();
    }

    /**
     * Make a GET request to a given API endpoint
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $queryParams = []): ResponseInterface
    {
        $url = $this->baseUrl . $endpoint;
        return $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ],
            'query' => $queryParams,
        ]);
    }

    /**
     * Fetch products from the Ecwid API with pagination
     *
     * @param int $limit
     * @param int $offset
     * @param int|null $category
     * @return array
     * @throws GuzzleException
     */
    public function fetchProducts(int $limit, int $offset, int $category = null): array
    {
        $response = $this->get('/products', [
            'category' =>  $category ?? config('ecwid.category_id'),
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
