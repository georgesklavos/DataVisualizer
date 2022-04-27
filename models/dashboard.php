<?php 

   function fetchDashboardData() {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/models/covid19Api.php";
        
        $response = $client->request('GET', 'summary');
        $collection = $db->dashboard;
        $dashboard = json_decode($response->getBody());
        $collection->deleteMany([]);
        $collection->insertOne($dashboard);
    };

    function getDashboard() {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        $collection = $db->dashboard;
        return $collection->findOne([]);
    }

?>