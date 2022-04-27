<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";
    $users = findUsers();

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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First name:</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First name">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last name:</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name">
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
                        <input type="text" class="form-control" id="password" placeholder="Password">
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
    <script src="./js/index.js"></script>
</body>

</html>