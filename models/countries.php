<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use GuzzleHttp\Client;
//'curl' => array( CURLOPT_SSL_VERIFYPEER => false)
$client = new Client(['verify' => false,'base_uri' => 'https://api.covid19api.com/']);

function fetchCountries() {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    global $client;
    $response = $client->request('GET', 'countries');
    $collection = $db->countries;
    $collection->insertMany(json_decode($response->getBody()));
};

function getCountries() {
    require $_SERVER['DOCUMENT_ROOT']."/config.php";
    $collection = $db->countries;
    return $collection->find([]);
}
?>