<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

//Check the method of the request
checkMethod('GET');
checkRole(null);


require $_SERVER['DOCUMENT_ROOT'] . "/models/summary.php";
//Fetch the country summary from the api
fetchCountrySummary($_GET['countryId'], $_GET['from'], $_GET['to']);

//Retrieve the data from our database
echo json_encode(getCountrySummary($_GET['countryId'], $_GET['from'], $_GET['to']));
