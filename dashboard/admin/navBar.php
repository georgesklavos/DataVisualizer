<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php 
    
    function checkUrl($value) {
        if (str_contains($_SERVER["REQUEST_URI"], $value)) {
            return true;
        }
        return false;

    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Data visualizer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarData" aria-controls="navBarData" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navBarData">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(checkUrl("/index.php")) { echo 'active'; } ?>" aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(checkUrl("/dashboard/admin/users.php")) { echo 'active'; } ?>" href="/dashboard/admin/users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(checkUrl("/dashboard/admin/countries.php")) { echo 'active'; } ?>" href="/dashboard/admin/countries.php">Countries</a>
                    </li>
                </ul>
                <div class="d-flex navbar-nav">
                    <a class="nav-link" href="../../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>