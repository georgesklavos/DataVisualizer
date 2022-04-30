<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to dashboard page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include config file
// require_once "config.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    if (empty($email_err) && empty($password_err)) {
        require "./models/users.php";

        // createUser("test","lastName", "20/05/2022", "test1@gmail.com", "12345");
        $user = userLogin($_POST["email"], $_POST["password"]);
        if ($user) {
            session_start();

            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user['_id'];
            $_SESSION["email"] = $user['email'];
            $_SESSION["role"] = $user['role'];
            if(isset($user['country'])) {
                $_SESSION['countryId'] = $user['country'];
            }
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

    <title>login</title>
</head>

<body>

    <?php
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card w-25">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <a href="/register.php">Register</a>
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>