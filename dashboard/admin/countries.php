<?php
session_start();
// session_destroy();

if (isset($_SESSION["role"]) && $_SESSION["role"] != 1) {
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
    <title>Document</title>
</head>
<body>
    <?php 
    require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";
    fetchCountries();
    include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    $countries = getCountries();
    ?>

<div class="toast-container position-absolute top-0 end-0 p-3" style="z-index: 1056;">
        <div id="successAlertCountries" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                   Countries have been updated successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

<div class="card border-0 mt-3">
        <div class="card-body pt-0">
        <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary mb-3" onclick="updateCountries()">Update countries
                        <span id="updateCountriesSpinner" hidden class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
        </div>
            <table class="table" data-page-list="[10, 25]" data-pagination="true">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Country</th>
                        <th scope="col">Slug</th>
                        <th scope="col">ISO2</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($countries as $key => $country) : ?>
                        <tr>
                            <th scope="row"><?= $country["_id"]; ?></th>
                            <td><?= $country["Country"]; ?></td>
                            <td><?= $country["Slug"]; ?></td>
                            <td><?= $country["ISO2"]; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="./js/countries.js"></script>
</html>