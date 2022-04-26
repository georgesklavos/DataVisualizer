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
    // fetchCountries();
    include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    $countries = getCountries();
    ?>

<div class="card border-0">
        <div class="card-body pt-0">
            <table class="table">
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
</html>