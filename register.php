<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$firstName = $lastName = $birthDate = $email = $password = "";
$firstName_err = $lastName_err = $birthDate_err = $email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if firstName is empty
    if (empty(trim($_POST["firstName"]))) {
        $firstName_err = "Please enter first name.";
    } else {
        $firstName = trim($_POST["firstName"]);
    }

    // Check if lastName is empty
    if (empty(trim($_POST["lastName"]))) {
        $lastName_err = "Please enter last name.";
    } else {
        $lastName = trim($_POST["lastName"]);
    }

    // Check if birthDate is empty
    if (empty(trim($_POST["birthDate"]))) {
        $birthDate_err = "Please enter birthDate.";
    } else {
        $birthDate = trim($_POST["birthDate"]);
    }

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty($firstName_err) && empty($lastName_err) && empty($birthDate_err) && empty($email_err) && empty($password_err)) {
        require "./models/users.php";

        createUser($firstName, $lastName, $birthDate, $email, $password);
        $user = userLogin($email, $password);
        if ($user) {
            session_start();

            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user['_id'];
            $_SESSION["email"] = $user['email'];
            $_SESSION["role"] = $user['role'];
            //   Redirect user to welcome page
            header("location: index.php");
            // var_dump($_SESSION);
        }
    }
}
?>


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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First name:</label>
                        <input type="text" name="firstName" class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" id="firstName" placeholder="First name">
                        <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last name:</label>
                        <input type="lastName" name="lastName" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" id="lastName" placeholder="Last name">
                        <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Birth date:</label>
                        <input type="date" name="birthDate" class="form-control <?php echo (!empty($birthDate_err)) ? 'is-invalid' : ''; ?>" id="birthDate" placeholder="Birth date">
                        <span class="invalid-feedback"><?php echo $birthDate_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" id="email" placeholder="Email address">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/">Login</a>
                        <input type="submit" class="btn btn-primary" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>