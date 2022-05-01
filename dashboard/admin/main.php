<?php
session_start();
// session_destroy();


if (!isset($_SESSION["role"]) && $_SESSION["role"] != 1) {
    session_destroy();
    header("location: /login.php");
}
?>

<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
</head>

<body>
    <?php

    include("./dashboard/admin/navBar.php");
    require_once $_SERVER['DOCUMENT_ROOT'] . "/models/dashboard.php";
    // require_once $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";

    fetchDashboardData();

    $dashboarData = getDashboard();
    // $countries = getCountries();
    ?>

    <h3 class="text-center">Data for: <?= date('Y-m-d', strtotime($dashboarData['Date'])); ?></h3>

    <div class="d-flex justify-content-evenly" style="height:37vh; max-width: 90vw;">


        <!-- <div class="d-flex align-items-center flex-column mt-5">
            <div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Total confirmed</h5>
                        <p class="card-text fs-3 text-secondary fw-bolder"><?= $dashboarData["Global"]["TotalConfirmed"]; ?> </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Total deaths</h5>
                        <p class="card-text fs-3 text-secondary fw-bolder"><?= $dashboarData["Global"]["TotalDeaths"]; ?> </p>
                    </div>
                </div>
            </div>
        </div> -->
        <div style="width:35vw !important;">
            <canvas id="totalBarChart"></canvas>
        </div>



        <div style="width:35vw !important;">
            <canvas id="newBarChart"></canvas>
        </div>


    </div>
    <div class="row justify-content-center">
        <div id="map" style="height: 50vh; width:90vw"></div>
    </div>
    <script>
        //Create the map

        var map = L.map('map').setView([39.07, 21.82], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const countriesInfo = <?= json_encode($dashboarData['Countries']); ?>;

        // console.log(countriesInfo);

        countriesInfo.forEach((el) => {
            if (el.info) {
                L.marker([el.info.lat, el.info.lon]).addTo(map)
                    .bindPopup(`
                        <h5 class="text-center mb-1 border-bottom">${el.info.display_name}</h5>
                        <p class="m-0"><b>New confirmed cases: </b>${el.NewConfirmed}</p>
                        <p class="m-0"><b>Deaths today: </b>${el.NewDeaths}</p>
                        <p class="m-0"><b>Recovered: </b>${el.NewRecovered}</p>
                        <p class="m-0"><b>Total confirmed cases: </b>${el.TotalConfirmed}</p>
                        <p class="m-0"><b>Total deaths: </b>${el.TotalDeaths}</p>
                    `)
                    .openPopup();
            }
        })




        //Total bar chart

        const totalLabels = [
            "Total confirmed",
            "Deaths"
        ];

        const totalData = {
            labels: totalLabels,
            datasets: [{
                label: 'Total data',
                backgroundColor: 'rgb(0, 14, 194)',
                borderColor: 'rgb(0, 0, 0)',
                data: [<?= $dashboarData["Global"]["TotalConfirmed"]; ?>, <?= $dashboarData["Global"]["TotalDeaths"]; ?>],
            }]
        };

        const totalConfig = {
            type: 'bar',
            data: totalData,
            options: {}
        };

        const totalBarChart = new Chart(
            document.getElementById('totalBarChart'),
            totalConfig
        );


        // new or daily data
        const labels = [
            "New confirmed",
            "Deaths"
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'New data',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?= $dashboarData["Global"]["NewConfirmed"]; ?>, <?= $dashboarData["Global"]["NewDeaths"]; ?>],
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const newBarChart = new Chart(
            document.getElementById('newBarChart'),
            config
        );
    </script>
</body>

</html>