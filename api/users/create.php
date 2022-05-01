<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

checkMethod('POST');
checkRole(1);

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

$data = json_decode(file_get_contents("php://input"));
createUser($data->firstName, $data->lastName, $data->birthDate,$data->email, $data->password,$data->country);

echo "User created!";
