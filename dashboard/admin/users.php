
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

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/models/countries.php";
    $users = findUsers();
    $countries = getCountries();

    ?>
    <div class="text-end  m-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Create user</button>
    </div>

    <div class="toast-container position-absolute top-0 end-0 p-3" style="z-index: 1056;">
        <div id="successAlert" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    User has been created successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create user</h5>
                    <button type="button" id="closeAddUser" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First name:</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First name">
                        <span id="invalidFirstName" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last name:</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name">
                        <span id="invalidLastName" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Birth date:</label>
                        <input type="date" class="form-control" id="birthDate" placeholder="Birth date">
                        <span id="invalidBirthDate" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Email address">
                        <span id="invalidEmail" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country:</label>
                        <div class="dropdown" id="country">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="countrySelecion" data-bs-toggle="dropdown" aria-expanded="false">
                            Select country
                        </button>
                        <ul id="userCountries" class="dropdown-menu" aria-labelledby="countrySelecion" style="height: 200px; overflow-y:scroll;">
                            <?php foreach ($countries as $country) : ?>
                                <li class="dropdown-item" id="<?= $country["_id"]; ?>">
                                    <?= $country["Country"]; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                        <span id="invalidCountry" class="invalid-feedback"></span>
                    </div>
                   
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="text" class="form-control" id="password" placeholder="Password">
                        <span id="invalidPassword" class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="createUser()">Create user
                        <span id="createUserSpinner" hidden class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body pt-0">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user) : ?>
                        <tr>
                            <th scope="row"><?= $user["_id"]; ?></th>
                            <td><?= $user["firstName"]; ?></td>
                            <td><?= $user["lastName"]; ?></td>
                            <td><?= $user["email"]; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="./js/users.js"></script>
</body>

</html>