<?php
session_start();

//check if the user is logged in
if (isset($_SESSION["role"]) && $_SESSION["role"] != 2) {
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
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
</head>

<body>

    <?php
    //include navigation bar file
    include("./dashboard/user/navBar.php");
    require_once $_SERVER['DOCUMENT_ROOT'] . "/models/dashboard.php";
    //fetch dashboard data from the api
    fetchDashboardData();

    //get dashboard data from the database
    $dashboarData = getDashboard();
    ?>

    <h3 class="text-center">Data for: <?= date('Y-m-d', strtotime($dashboarData['Date'])); ?></h3>

    <div class="d-flex justify-content-evenly" style="height:37vh; max-width: 90vw;">

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

        //Get the countries that shows up in the map
        const countriesInfo = <?= json_encode($dashboarData['Countries']); ?>;

        //Create the pins and add the data for each country
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




        //Labels of bar chart
        const totalLabels = [
            "Total confirmed",
            "Deaths"
        ];

        //Data of the bar chart
        const totalData = {
            labels: totalLabels,
            datasets: [{
                label: 'Total data',
                backgroundColor: 'rgb(0, 14, 194)',
                borderColor: 'rgb(0, 0, 0)',
                data: [<?= $dashboarData["Global"]["TotalConfirmed"]; ?>, <?= $dashboarData["Global"]["TotalDeaths"]; ?>],
            }]
        };

        //Config of the bar chart
        const totalConfig = {
            type: 'bar',
            data: totalData,
            options: {}
        };

        //Create the bar chart
        const totalBarChart = new Chart(
            document.getElementById('totalBarChart'),
            totalConfig
        );


        //Labels for the bar chart that shows new or daily data
        const labels = [
            "New confirmed",
            "Deaths"
        ];

        //Data for the bar chart
        const data = {
            labels: labels,
            datasets: [{
                label: 'New data',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?= $dashboarData["Global"]["NewConfirmed"]; ?>, <?= $dashboarData["Global"]["NewDeaths"]; ?>],
            }]
        };

        //Config for the bar chart
        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        //Create the bar chart that shows the new data
        const newBarChart = new Chart(
            document.getElementById('newBarChart'),
            config
        );
    </script>
</body>

</html>