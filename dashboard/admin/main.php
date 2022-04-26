<?php
session_start();
// session_destroy();

if (isset($_SESSION["role"]) && $_SESSION["role"] != 1) {
    session_destroy();
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>
</head>

<body>
<?php include("./dashboard/admin/navBar.php");?>

    <h1>Dashboard admin</h1>
</body>

</html>