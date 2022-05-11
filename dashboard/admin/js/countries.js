// Function that call the fetch countries api
async function updateCountries() {
  document.getElementById("updateCountriesSpinner").hidden = false;

  await fetch("/api/countries/update.php", {
    method: "PUT",
  }).then(() => {
    // //Show alert after successful completion of the request
    // const successAlert = document.getElementById("successAlertCountries");

    // const toast = new bootstrap.Toast(successAlert);
    // toast.show();
  });
  document.getElementById("updateCountriesSpinner").hidden = true;
  location.reload();
}
