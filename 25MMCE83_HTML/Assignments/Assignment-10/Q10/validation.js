function validate(ev) {

    let name = document.getElementById("name").value;
    let dob = document.getElementById("dob").value;
    let address = document.getElementById("address").value;
    let mobile = document.getElementById("mobile").value;
    let email = document.getElementById("email").value;
    let country = document.getElementById("country").value;
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;

    let namePattern = /^[A-Za-z ]{3,}$/;
    let mobilePattern = /^[6-9][0-9]{9}$/;
    let emailPattern = /^[A-Za-z0-9\._]{3,}@[A-Za-z0-9\.]{2,}\.[a-z]{2,5}$/;

    let valid = true;

    // Clear previous errors
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("genderError").innerHTML = "";
    document.getElementById("dobError").innerHTML = "";
    document.getElementById("addressError").innerHTML = "";
    document.getElementById("mobileError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("countryError").innerHTML = "";
    document.getElementById("passwordError").innerHTML = "";
    document.getElementById("password2Error").innerHTML = "";

    // Name validation
    if(!namePattern.test(name)) {
        document.getElementById("nameError").innerHTML =
        "Enter a valid name";
        valid = false;
    }

    // Gender validation
    if(!document.getElementById("male").checked &&
       !document.getElementById("female").checked &&
       !document.getElementById("other").checked) {

        document.getElementById("genderError").innerHTML =
        "Please select gender";
        valid = false;
    }

    // DOB validation
    if(dob == "") {
        document.getElementById("dobError").innerHTML =
        "Please select DOB";
        valid = false;
    }

    // Address validation
    if(address.length < 10) {
        document.getElementById("addressError").innerHTML =
        "Address must contain at least 10 characters";
        valid = false;
    }

    // Mobile validation
    if(!mobilePattern.test(mobile)) {
        document.getElementById("mobileError").innerHTML =
        "Enter a valid 10 digit mobile number";
        valid = false;
    }

    // Email validation
    if(!emailPattern.test(email)) {
        document.getElementById("emailError").innerHTML =
        "Enter a valid email";
        valid = false;
    }

    // Country validation
    if(country == "") {
        document.getElementById("countryError").innerHTML =
        "Please select country";
        valid = false;
    }

    // Password validation
    if(password.length < 8 || password.length > 16) {
        document.getElementById("passwordError").innerHTML =
        "Password must be between 8 and 16 characters";
        valid = false;
    }

    // Confirm password validation
    if(password2 != password || password2 == "") {
        document.getElementById("password2Error").innerHTML =
        "Password does not match";
        valid = false;
    }

    if(!valid) {
        ev.preventDefault();
    }
}