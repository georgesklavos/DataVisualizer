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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";
    $countries = getCountries();
    ?>

    <div class="d-flex justify-content-evenly mt-3 mb-3">

        <div>
            <select id="countrySummary" name="country" class="form-select" aria-label="Default select example">
                <option selected>Choose a country</option>
                <?php foreach ($countries as $country) : ?>
                    <option value="<?= $country["_id"]; ?>"><?= $country["Country"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="d-flex">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="fromPeriod" class="form-label m-0">From:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="fromPeriod" placeholder="From" max="<?= date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto" style="margin-left: 20px;">
                    <label for="toPeriod" class="form-label m-0">To:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="toPeriod" placeholder="To" disabled max="<?= date('Y-m-d'); ?>">
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="button" id="searchForData" disabled>
            Search for data
        </button>
    </div>

    <div class="spinner-border text-primary" id="loader" role="status" hidden>
        <span class="visually-hidden">Loading...</span>
    </div>




    <div class="d-flex justify-content-between">
        <div style="width: 43vw;">
            <canvas id="totalSummaryBarChart"></canvas>
        </div>
        <div>
            <div id="countryMap" style="height: 35vh; width:30vw;"></div>
        </div>
    </div>
    <div class="d-flex pl-2">
        <div style="height: 43vh; width:100vw;">
            <canvas id="summaryLineChart"></canvas>
        </div>
    </div>


</body>
<script src="./js/summary.js"></script>
<style>
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 100px;
        height: 100px;
    }
</style>

</html>