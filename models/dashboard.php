<?php 

   function fetchDashboardData() {
        require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/covid19Api.php";
        
        $response = $client->request('GET', 'summary');
        $collection = $db->dashboard;
        $dashboard = json_decode($response->getBody());
        $collection->deleteMany([]);
        $collection->insertOne($dashboard);
    };

    function getDashboard() {
        require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        $dashboardCollection = $db->dashboard;
        $dashboardData = $dashboardCollection->findOne([]);
        $countriesCollection = $db->countries;
        $countries = iterator_to_array($countriesCollection->find([]));
        foreach ($dashboardData['Countries'] as $dashboardCountry) {
            foreach ($countries as $country) {
                if($country['Slug'] == $dashboardCountry['Slug']) {
                    $dashboardCountry->info = $country->info;
                    break;
                }
            }
        }
        return $dashboardData;
    }
?>