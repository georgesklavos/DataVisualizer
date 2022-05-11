<?php

use GuzzleHttp\Client;

//Fetch the countries from the api
function fetchCountries()
{
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/covid19Api.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/nominatimApi.php";

    //Get the countries from the api
    $response = $client->request('GET', 'countries');
    $collection = $db->countries;
    $countries = json_decode($response->getBody());


    //Chnage the max execution time because of the big amount of incoming data
    ini_set('max_execution_time', '700');

    foreach ($countries as $country) {
        //Get the coordinates for each country
        error_log(print_r("Data for country: " . $country->Country, TRUE));
        $responseLocation = $clientLocationData->request('GET', 'search.php?q=' . $country->Country . '&format=jsonv2&accept-language=en');
        $responseLocation = json_decode($responseLocation->getBody());
        $country->info = array_values($responseLocation)[0];

        //Update if it exists or insert new if it doesnt
        $collection->updateOne(['Country' => $country->Country], ['$set' => $country], ["upsert" => true]);
    }
};

//Get the countries from the database
function getCountries()
{
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $collection = $db->countries;
    return $collection->find([])->toArray();
}
