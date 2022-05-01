<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/apiUtils.php";

checkMethod('GET');

require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

echo json_encode(iterator_to_array(findUsers()));

?>