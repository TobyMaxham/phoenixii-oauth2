# PhoenixII OAuth2
A PHP package to use the PhoenixII OAuth2 API. Visit [PhoenixII-Wiki](https://tricept.atlassian.net/wiki/spaces/PIIWIKI/pages/976912387/OAuth+2+-+Schnittstelle) for more Details.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tobymaxham/phoenixii-oauth2.svg?style=flat-square)](https://packagist.org/packages/tobymaxham/phoenixii-oauth2)
[![GitHub commits](https://img.shields.io/github/commits-since/tobymaxham/phoenixii-oauth2/v1.0.svg)](https://GitHub.com/tobymaxham/phoenixii-oauth2/commit/)
[![Total Downloads](https://img.shields.io/packagist/dt/tobymaxham/phoenixii-oauth2.svg?style=flat-square)](https://packagist.org/packages/tobymaxham/phoenixii-oauth2)
[![GitHub contributors](https://img.shields.io/github/contributors/tobymaxham/phoenixii-oauth2.svg)](https://GitHub.com/TobyMaxham/phoenixii-oauth2/graphs/contributors/)
[![GitHub issues](https://img.shields.io/github/issues/tobymaxham/phoenixii-oauth2.svg)](https://GitHub.com/TobyMaxham/phoenixii-oauth2/issues/)


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
