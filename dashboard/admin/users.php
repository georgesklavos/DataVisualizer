<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/navBar.php");
    require $_SERVER['DOCUMENT_ROOT'] . "/models/users.php";
    $users = findUsers();

    ?>
    <div class="text-end  m-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">Create user</button>
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
                    <button type="button" class="btn btn-primary" onclick="createUser()">Create user</button>
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


    <script>
        function createUser() {
            console.log("create user");
        }
    </script>
</body>

</html>