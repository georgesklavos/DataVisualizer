<?php 

    function fetchCountrySummary($country, $from, $to) {
        require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/covid19Api.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/nominatimApi.php";

        $countrySummaryData = new stdClass();
        $countrySummaryData->country = $country;
        $countrySummaryData->from = $from;
        $countrySummaryData->to = $to;

        $collection = $db->countrySummary;

        $responseTotal = $client->request('GET', 'total/country/'.$country);
        $countryTotal = json_decode($responseTotal->getBody());
        
        $response = $client->request('GET', 'country/'.$country.'?from='.$from.'&to='.$to);
        $countrySummaryCovid = json_decode($response->getBody());

        $countrySummaryData->covidData = $countrySummaryCovid;
        $countrySummaryData->total = end(array_values($countryTotal));
            
        $responseLocation = $clientLocationData->request('GET', 'search.php?q='. $country .'&polygon_geojson=1&format=jsonv2&accept-language=en');
        $responseLocation = json_decode($responseLocation->getBody());
        
        $countrySummaryData->location = array_values($responseLocation)[0];

        $collection->updateOne(['country' => $countrySummaryData->country, 'from' => $countrySummaryData->from, 'to' => $countrySummaryData->to], ['$set' => $countrySummaryData], ["upsert" => true]);

        // foreach($countries as $country) {
        //     // https://nominatim.openstreetmap.org/search?<params>
        //     //Get the geolocation data for each country
        //     error_log(print_r("Data for country: " . $country->Country, TRUE));
        //     $responseLocation = $clientLocationData->request('GET', 'search.php?q='. $country->Country .'&format=jsonv2&accept-language=en');
        //     $responseLocation = json_decode($responseLocation->getBody());
        //     $country->info = array_values($responseLocation)[0];
    
        //     //https://nominatim.openstreetmap.org/search.php?country=Myanmar&polygon_geojson=1&format=jsonv2
        //     $collection->updateOne(['Country' => $country->Country], ['$set' => $country], ["upsert" => true]);
        //     // break;
        // }
    }

    function getCountrySummary($country, $from, $to) {

        require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        $collection = $db->countrySummary;

        return $collection->findOne(['country' => $country, 'from' => $from, 'to' => $to]);
    }

    ?>