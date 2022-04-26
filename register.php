<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card w-25">
            <div class="card-header">
                Register
            </div>
            <div class="card-body">
            <div class="mb-3">
                    <label for="firstName" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="firstName" placeholder="First name">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last name:</label>
                    <input type="lastName" class="form-control" id="lastName" placeholder="Last name">
                </div>
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Birth date:</label>
                    <input type="date" class="form-control" id="birthDate" placeholder="Birth date">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Email address">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/">Login</a>
                    <a href="/dashboard.php" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

