<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";

// echo json_encode(iterator_to_array(findUsers()));

  require $_SERVER['DOCUMENT_ROOT'] . "/models/summary.php";
  fetchCountrySummary($_GET['country'], $_GET['from'],$_GET['to']);

  echo json_encode(getCountrySummary($_GET['country'], $_GET['from'],$_GET['to']));
?>