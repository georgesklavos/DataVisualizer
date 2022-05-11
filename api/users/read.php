<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

//Check the method of the request
checkMethod('GET');

//Check that the user has role 1 (Admin)
checkRole(1);

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";
//Get the users of the database
echo json_encode(iterator_to_array(findUsers()));
