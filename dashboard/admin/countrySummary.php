<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";
    $countries = getCountries();
    ?>

    <div class="d-flex justify-content-evenly mt-3 mb-3">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="countries" data-bs-toggle="dropdown" aria-expanded="false">
                Select country
            </button>
            <ul id="countriesSelection" class="dropdown-menu" aria-labelledby="countries" style="height: 200px; overflow-y:scroll;">
                <?php foreach ($countries as $country) : ?>
                    <li class="dropdown-item" id="<?= $country["_id"]; ?>">
                        <?= $country["Country"]; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="d-flex">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="fromPeriod" class="form-label m-0">From:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="fromPeriod" placeholder="From">
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto" style="margin-left: 20px;">
                    <label for="toPeriod" class="form-label m-0">To:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="toPeriod" placeholder="To">
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
</body>
<script src="./js/index.js"></script>
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