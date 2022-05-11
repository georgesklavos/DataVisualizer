<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

//Check the method of the request
checkMethod('POST');

//Check the role of the user is 1 (Admin)
checkRole(1);

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

//Read the incoming data
$data = json_decode(file_get_contents("php://input"));
//Create the new user
createUser($data->firstName, $data->lastName, $data->birthDate, $data->email, $data->password, $data->country);

echo "User created!";
