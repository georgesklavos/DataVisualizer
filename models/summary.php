<?php
//Get the summary for the given country
function fetchCountrySummary($countryId, $from, $to)
{
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/covid19Api.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/nominatimApi.php";

    $collectionCountries = $db->countries;

    //Find the country in the database
    $countrySelected = $collectionCountries->findOne(['_id' => new MongoDB\BSON\ObjectId($countryId)]);

    if ($countrySelected) {
        //Add the country, from and to value
        $countrySummaryData = new stdClass();
        $countrySummaryData->country = $countrySelected['Country'];
        $countrySummaryData->from = $from;
        $countrySummaryData->to = $to;

        $collection = $db->countrySummary;

        //Get the total statistics for the country
        $responseTotal = $client->request('GET', 'total/country/' . $countrySelected['Country']);
        $countryTotal = json_decode($responseTotal->getBody());

        //Get the data for the country during the given period
        $response = $client->request('GET', 'country/' . $countrySelected['Country'] . '?from=' . $from . '&to=' . $to);
        $countrySummaryCovid = json_decode($response->getBody());

        $countrySummaryData->covidData = $countrySummaryCovid;
        //Select the last that has the total values
        $totalData = array_values($countryTotal);
        $countrySummaryData->total = end($totalData);

        //Search for the geojson coordinates
        $responseLocation = $clientLocationData->request('GET', 'search.php?q=' . $countrySelected['Country'] . '&polygon_geojson=1&format=jsonv2&accept-language=en');
        $responseLocation = json_decode($responseLocation->getBody());

        $countrySummaryData->location = array_values($responseLocation)[0];

        //Update or insert if it doesnt exist
        $collection->updateOne(['country' => $countrySummaryData->country, 'from' => $countrySummaryData->from, 'to' => $countrySummaryData->to], ['$set' => $countrySummaryData], ["upsert" => true]);
    }
}

//Get the summary of the country for a given period
function getCountrySummary($countryId, $from, $to)
{

    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $collectionCountries = $db->countries;
    //Seach for the country
    $countrySelected = $collectionCountries->findOne(['_id' => new MongoDB\BSON\ObjectId($countryId)]);
    //Check that the country exists
    if ($countrySelected) {
        $collection = $db->countrySummary;
        //Search for the country summary data
        return $collection->findOne(['country' => $countrySelected['Country'], 'from' => $from, 'to' => $to]);
    }
}
