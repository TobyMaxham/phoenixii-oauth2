<?php

namespace TobyMaxham\PhoenixAuth;

use stdClass;
use TobyMaxham\PhoenixAuth\Resource\PhoenixResource;

/**
 * @author Tobias Maxham <git2019@maxham.de>
 */
class AccessToken
{
    protected $refresh_token;
    protected $access_token;
    protected $expires_in;
    protected $user_data;

    public function __construct(stdClass $data)
    {
        $this->refresh_token = $data->refresh_token;
        $this->access_token = $data->access_token;
        $this->user_data = $data->data;
        $this->expires_in = $data->expires_in;
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    public function getResource($type): PhoenixResource
    {
        $class = ucfirst(strtolower($type)).'Resource';
        $class = 'TobyMaxham\\PhoenixAuth\\Resource\\'.$class;

        return new $class($this->user_data);
    }
}
