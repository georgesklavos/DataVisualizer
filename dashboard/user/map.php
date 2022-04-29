
<?php
session_start();
// session_destroy();

if (isset($_SESSION["role"]) && $_SESSION["role"] != 2) {
  session_destroy();
  header("location: /login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
</head>
<body>
    <?php include("./navBar.php");?>

    <h1>Map</h1>
</body>
</html>