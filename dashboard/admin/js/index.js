function createUser() {
    console.log("create user");
    document.getElementById("createUserSpinner").hidden = false;
    const successAlert = document.getElementById('successAlert');

    const toast = new bootstrap.Toast(successAlert);
    toast.show();

}