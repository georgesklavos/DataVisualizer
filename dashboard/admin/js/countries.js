async function updateCountries() {
  document.getElementById("updateCountriesSpinner").hidden = false;

  await fetch("/api/countries/update.php", {
    method: "POST",
  }).then(() => {
    const successAlert = document.getElementById("successAlertCountries");

    const toast = new bootstrap.Toast(successAlert);
    toast.show();
  });
  document.getElementById("updateCountriesSpinner").hidden = true;
}
