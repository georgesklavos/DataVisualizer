<?php 
use GuzzleHttp\Client;

function fetchCountries() {
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/covid19Api.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/nominatimApi.php";
    
    $response = $client->request('GET', 'countries');
    $collection = $db->countries;
    $countries = json_decode($response->getBody());

//'curl' => array( CURLOPT_SSL_VERIFYPEER => false)
    
    ini_set('max_execution_time', '700');  
        
    foreach($countries as $country) {
        // https://nominatim.openstreetmap.org/search?<params>
        //Get the geolocation data for each country
        error_log(print_r("Data for country: " . $country->Country, TRUE));
        $responseLocation = $clientLocationData->request('GET', 'search.php?q='. $country->Country .'&format=jsonv2&accept-language=en');
        $responseLocation = json_decode($responseLocation->getBody());
        $country->info = array_values($responseLocation)[0];

        //https://nominatim.openstreetmap.org/search.php?country=Myanmar&polygon_geojson=1&format=jsonv2
        $collection->updateOne(['Country' => $country->Country], ['$set' => $country], ["upsert" => true]);
        // break;
    }

};

function getCountries() {
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $collection = $db->countries;
    return $collection->find([]);
}
?>