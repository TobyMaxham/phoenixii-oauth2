# PhoenixII OAuth2
A PHP package to use the PhoenixII OAuth2 API. Visit [PhoenixII-Wiki](https://tricept.atlassian.net/wiki/spaces/PIIWIKI/pages/976912387/OAuth+2+-+Schnittstelle) for more Details.


## Installation

```ssh
composer require tobymaxham/phoenixii-oauth2
```


## Usage

See `samples/*` for more Details.
```php
$client = new AuthProvider($baseUrl, $client_id, $client_secret, $bearer_token);
$token = $client->getAccessToken('authorization_code', [
    'code' => urldecode($code]),
]);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
