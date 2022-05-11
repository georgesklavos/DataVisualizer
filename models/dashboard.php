<?php
//Fetch the dashboard data from the api
function fetchDashboardData()
{
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/covid19Api.php";

    //Get dashboard data
    $response = $client->request('GET', 'summary');
    $collection = $db->dashboard;
    $dashboard = json_decode($response->getBody());
    //Delete all the entries
    $collection->deleteMany([]);

    //Save the new dashboard data
    $collection->insertOne($dashboard);
};

//Get dashboard data from the database
function getDashboard()
{
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    $dashboardCollection = $db->dashboard;
    //Search for the dashboard data
    $dashboardData = $dashboardCollection->findOne([]);
    $countriesCollection = $db->countries;
    //Search for the countries
    $countries = iterator_to_array($countriesCollection->find([]));

    //Get for each country in the dashboard data their coordinates
    foreach ($dashboardData['Countries'] as $dashboardCountry) {
        foreach ($countries as $country) {
            if ($country['Slug'] == $dashboardCountry['Slug']) {
                $dashboardCountry->info = $country->info;
                break;
            }
        }
    }
    return $dashboardData;
}
