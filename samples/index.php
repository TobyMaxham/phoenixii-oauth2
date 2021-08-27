<?php

use TobyMaxham\PhoenixAuth\AccessToken;
use TobyMaxham\PhoenixAuth\AuthProvider;

require '../vendor/autoload.php';

$bearer_token = '';
$client_id = '';
$client_secret = '';
$redirectURL = 'http://127.0.0.1:8777/';
$baseUrl = 'https://{mandant}.it4sport.de/oauth2';

session_start();

if (! isset($_SESSION['state'])) {
    $_SESSION['state'] = uniqid();
}

$client = new AuthProvider($baseUrl, $client_id, $client_secret, $bearer_token);

if (! isset($_GET['state'])) {
    echo '<button onclick="window.location.href=\''.$client->getAuthorizationUrl($_SESSION['state'], $redirectURL).'\'">Login/Register with PhoenixII</button>';
    exit();
}

// validate state
if ($_GET['state'] != $_SESSION['state']) {
    echo 'Invalid Request. Try again.';
    exit();
}

// validate user has denied
if (isset($_GET['error']) && !empty($_GET['error'])) {
    echo 'User has denied. Try again.';
    echo '<br>Error: '. $_GET['error'];
    exit();
}

echo '<pre>';

/** @var AccessToken $token */
$token = $client->getAccessToken('authorization_code', [
    'code'         => urldecode($_GET['code']),
    'redirect_uri' => $redirectURL,
]);

echo "access_token: {$token->getAccessToken()}<br>";
echo "refresh_token: {$token->getRefreshToken()}<br>";

echo '<br>';

echo 'functions:<br>';
var_dump($token->getResource('functions')->data());

echo '<br>';

echo 'licenses:<br>';
var_dump($token->getResource('licenses')->data());

echo '<br>';

echo 'communications:<br>';
var_dump($token->getResource('communications')->data());

echo '<br>';

echo 'addresses:<br>';
var_dump($token->getResource('addresses')->data());

