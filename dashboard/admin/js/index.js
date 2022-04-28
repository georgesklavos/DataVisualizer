function createUser() {
    console.log("create user");
    document.getElementById("createUserSpinner").hidden = false;
    const successAlert = document.getElementById('successAlert');

    const toast = new bootstrap.Toast(successAlert);
    toast.show();

}

async function updateCountries() {
    document.getElementById("updateCountriesSpinner").hidden = false;

    await fetch("/api/countries/update.php", {
        method: "POST"
    }).then(() => {
        const successAlert = document.getElementById('successAlertCountries');
    
        const toast = new bootstrap.Toast(successAlert);
        toast.show();
    })
    document.getElementById("updateCountriesSpinner").hidden = true;

}

let selectedCountry = {};
const selectedFrom = document.getElementById("fromPeriod");
const selectedTo = document.getElementById("toPeriod");
const searchButton = document.getElementById("searchForData");
const loader = document.getElementById("loader");
let countryOptions = document.querySelectorAll('#countriesSelection > li');

function checkForSelectedData() {
    searchButton.disabled = (selectedCountry && selectedFrom.value != "" && selectedTo.value != "") == true ? false : true;  
}

countryOptions.forEach(el => {
    el.addEventListener('click', function(){
        selectedCountry = {
            id: this.getAttribute("id"),
            name: this.innerText
        }
        document.getElementById("countries").innerText = selectedCountry.name;
        checkForSelectedData();
    });
})

selectedFrom.addEventListener("change", function() {
    checkForSelectedData();
})

selectedTo.addEventListener("change", function() {
    checkForSelectedData();
})

searchButton.addEventListener('click', function() {
    console.log('search');
    console.log(selectedCountry);
    console.log(selectedFrom.value);
    console.log(selectedTo.value);
    loader.hidden = false;
})