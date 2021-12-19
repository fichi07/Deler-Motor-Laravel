<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");

$user_id = $_SESSION["user"];

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

try {
    $client = new Client([
        'base_uri' => 'http://127.0.0.1:8000',
        'timeout' => 5
    ]);
    $response =  $client->request('DELETE', '/api/motor/' . $_GET['id'], [
        'json' => []
    ]);

    $body = $response->getBody();
    // $data_body = json_decode($body, true);

    header('location:dashboard_admin.php');
} catch (RuntimeException $e) {
    echo $e->getMessage();
}
