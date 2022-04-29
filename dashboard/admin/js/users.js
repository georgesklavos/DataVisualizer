// input fields
let firstName = document.getElementById('firstName');
let lastName = document.getElementById('lastName');
let birthDate = document.getElementById('birthDate');
let email = document.getElementById('email');
let password = document.getElementById('password');
let countryOptions = document.querySelectorAll("#userCountries > li");
let selectedCountry = null;

// error messages
let firstNameErr = document.getElementById('invalidFirstName');
let lastNameErr = document.getElementById('invalidLastName');
let birthDateErr = document.getElementById('invalidBirthDate');
let emailErr = document.getElementById('invalidEmail');
let passwordErr = document.getElementById('invalidPassword');
let countryErr = document.getElementById('invalidCountry');


countryOptions.forEach((el) => {
    el.addEventListener("click", function () {
      selectedCountry = {
        id: this.getAttribute("id"),
        name: this.innerText,
      };
      document.getElementById("countrySelecion").innerText = selectedCountry.name;
    });
  });


function checkData() {
    let valid = true;
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.value = "";
    });

    countryErr.style.display = 'none';

    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove("is-invalid");
    })

    if(!firstName.value) {
        firstName.classList.add("is-invalid");
        firstNameErr.innerHTML  = "Please enter first name."
        valid = false;
    }

    if(!lastName.value) {
        lastName.classList.add("is-invalid");
        lastNameErr.innerHTML  = "Please enter last name."
        valid = false;
    }

    if(!birthDate.value) {
        birthDate.classList.add("is-invalid");
        birthDateErr.innerHTML  = "Please enter birthDate."
        valid = false;
    }

    if(!email.value) {
        email.classList.add("is-invalid");
        emailErr.innerHTML  = "Please enter email."
        valid = false;
    }

    if(!password.value) {
        password.classList.add("is-invalid");
        passwordErr.innerHTML  = "Please enter your password."
        valid = false;
    }
    
    console.log(selectedCountry);
    if(selectedCountry == null) {
        // document.getElementById('countrySelecion').classList.add("is-invalid");
        countryErr.innerHTML = "Please select a country";
        countryErr.style.display = 'block';
        valid = false;
    }

    return valid;
}

async function createUser() {
    
    if(checkData()) {
        document.getElementById("createUserSpinner").hidden = false;
        await fetch(`/api/users/create.php?firstName=${firstName.value}&lastName=${lastName.value}&birthDate=${birthDate.value}&email=${email.value}&password=${password.value}&country=${selectedCountry.id}`,{
            method: "POST"
        });
    
        document.getElementById("createUserSpinner").hidden = true;
    
        document.querySelectorAll('input').forEach(el => {
            el.value = '';
        });

        document.getElementById("countrySelecion").innerText = 'Select country';
        selectedCountry = null;
        countryErr.style.display = 'none';

        const successAlert = document.getElementById('successAlert');
    
        const toast = new bootstrap.Toast(successAlert);
        toast.show();

        // let modal = bootstrap.Modal.getInstance(document.getElementById('addUser'))
        // modal.hide();
        document.getElementById('closeAddUser').click();
    }


}