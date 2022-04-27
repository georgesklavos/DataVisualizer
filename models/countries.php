<?php 
use GuzzleHttp\Client;

function fetchCountries() {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/models/covid19Api.php";
    
    $response = $client->request('GET', 'countries');
    $collection = $db->countries;
    $countries = json_decode($response->getBody());

//'curl' => array( CURLOPT_SSL_VERIFYPEER => false)
// $clientLocationData = new Client(['verify' => false,'base_uri' => "https://nominatim.openstreetmap.org/"]);   
    foreach($countries as $country) {
        // https://nominatim.openstreetmap.org/search?<params>
        // $responseLocation = $clientLocationData->request('GET', 'search.php?country=Myanmar&polygon_geojson=1&format=jsonv2');
        // $responseLocation = json_decode($responseLocation->getBody());
        // $country->info = array_values($responseLocation)[0];
        $collection->updateOne(['Country' => $country->Country], ['$set' => $country], ["upsert" => true]);
        // break;
    }

};

function getCountries() {
    require $_SERVER['DOCUMENT_ROOT']."/config.php";
    $collection = $db->countries;
    return $collection->find([]);
}
?>