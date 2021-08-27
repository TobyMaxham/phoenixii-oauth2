<?php

namespace TobyMaxham\PhoenixAuth;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ServerException;
use TobyMaxham\PhoenixAuth\Support\Helper;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
class AuthProvider
{
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $bearer_token;
    private $base_uri;

    /**
     * @var HttpClient
     */
    protected $http_client;

    public function __construct($base_uri, $client_id, $client_secret, $bearer_token)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->bearer_token = $bearer_token;
        $this->http_client = new HttpClient(['base_uri' => $base_uri]);
        $this->base_uri = $base_uri;
    }

    /**
     * @param null $state
     * @param null $redirect_uri
     */
    public function getAuthorizationUrl($state = null, $redirect_uri = null): string
    {
        $url = $this->base_uri."/authorize?client_id={$this->client_id}&response_type=code";
        if ($redirect_uri) {
            $url .= "&redirect_uri={$redirect_uri}";
        }
        if ($state) {
            $url .= "&state={$state}";
        }

        return $url;
    }

    public function client(): HttpClient
    {
        return $this->http_client;
    }

    public function getAccessToken($grant, array $options = []): AccessToken
    {
        $grant = $this->verifyGrant($grant);

        $params = [
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri'  => isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri,
        ];

        $params = $this->prepareRequestParameters($params, $options);
        $jsonResponse = $this->getAccessTokenRequest($params);
        $response = $this->getParsedResponse($jsonResponse);

        return new AccessToken($response);
    }

    private function prepareRequestParameters($params, $options): array
    {
        return array_merge($params, $options);
    }

    /**
     * @throws Exception
     */
    private function verifyGrant(string $grant): string
    {
        if ('authorization_code' != $grant) {
            throw new Exception('Invalid grant_type');
        }

        return $grant;
    }

    private function getAccessTokenRequest(array $params)
    {
        $headers = [
        'Authorization' => 'Bearer '.$this->getBearerToken(),
        'Accept'        => 'application/json',
    ];
        $options = Helper::except($params, ['grant_type', 'client_id', 'client_secret']);
        $jsonBody = array_merge($options, [
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
        ]);

        try {
            $response = $this->client()->request('POST', $this->base_uri.'/access_token', [
                'headers' => $headers,
                'json'    => $jsonBody,
            ]);
            $jsonResponse = json_decode($response->getBody());
        } catch (ServerException $exception) {
            $jsonResponse = json_decode($exception->getResponse()->getBody());
        }

        return $jsonResponse;
    }

    private function getBearerToken(): string
    {
        return $this->bearer_token;
    }

    private function getParsedResponse($jsonResponse)
    {
        if (null == $jsonResponse) {
            throw new Exception('Oops. Something went wrong');
        }

        return $jsonResponse;
    }
}
