// Set maximum date to today's date
let date = new Date();

let year = date.getFullYear();
let month = date.getMonth() + 1;
let day = date.getDate();

if(month < 10) {
    month = "0" + month;
}

if(day < 10) {
    day = "0" + day;
}

let today = year + "-" + month + "-" + day;

document.getElementById("dob").max = today;


// Full Name Validation
function validateName() {

    let name = document.getElementById("name").value;
    let pattern = /^[A-Za-z ]+$/;

    if(name == "" || !pattern.test(name)) {
        document.getElementById("nameError").innerHTML =
        "Enter a valid name using only letters and spaces";
        return false;
    }
    else {
        document.getElementById("nameError").innerHTML = "";
        return true;
    }
}


// Gender Validation
function validateGender() {

    if(!document.getElementById("male").checked &&
       !document.getElementById("female").checked &&
       !document.getElementById("other").checked) {

        document.getElementById("genderError").innerHTML =
        "Please select your gender";
        return false;
    }
    else {
        document.getElementById("genderError").innerHTML = "";
        return true;
    }
}


// Username Validation
function validateUsername() {

    let username = document.getElementById("username").value;
    let pattern = /^[^ ]{5,}$/;

    if(!pattern.test(username)) {
        document.getElementById("usernameError").innerHTML =
        "Username must contain at least 5 characters without spaces";
        return false;
    }
    else {
        document.getElementById("usernameError").innerHTML = "";
        return true;
    }
}


// Email Validation
function validateEmail() {

    let email = document.getElementById("email").value;

    let pattern = /^[A-Za-z0-9\._]{3,}@[A-Za-z0-9\.]{2,}\.[a-z]{2,5}$/;

    if(!pattern.test(email)) {
        document.getElementById("emailError").innerHTML =
        "Enter a valid email address";
        return false;
    }
    else {
        document.getElementById("emailError").innerHTML = "";
        return true;
    }
}


// Mobile Number Validation
function validateMobile() {

    let mobile = document.getElementById("mobile").value;
    let pattern = /^[0-9]{10}$/;

    if(!pattern.test(mobile)) {
        document.getElementById("mobileError").innerHTML =
        "Mobile number must contain exactly 10 digits";
        return false;
    }
    else {
        document.getElementById("mobileError").innerHTML = "";
        return true;
    }
}


// Date of Birth Validation
function validateDOB() {

    let dob = document.getElementById("dob").value;

    if(dob == "") {
        document.getElementById("dobError").innerHTML =
        "Please select your date of birth";
        return false;
    }

    let dobParts = dob.split("-");

    let birthYear = parseInt(dobParts[0]);
    let birthMonth = parseInt(dobParts[1]);
    let birthDay = parseInt(dobParts[2]);

    let age = year - birthYear;

    if(month < birthMonth ||
       (month == birthMonth && day < birthDay)) {
        age--;
    }

    if(age < 18) {
        document.getElementById("dobError").innerHTML =
        "You must be at least 18 years old";
        return false;
    }
    else {
        document.getElementById("dobError").innerHTML = "";
        return true;
    }
}


// Country Validation
function validateCountry() {

    let country = document.getElementById("country").value;

    if(country == "") {
        document.getElementById("countryError").innerHTML =
        "Please select your country";
        return false;
    }
    else {
        document.getElementById("countryError").innerHTML = "";
        return true;
    }
}


// Password Validation
function validatePassword() {

    let password = document.getElementById("password").value;

    let upper = /[A-Z]/;
    let lower = /[a-z]/;
    let number = /[0-9]/;
    let special = /[!@#$%^&*]/;

    if(password.length < 8 ||
       !upper.test(password) ||
       !lower.test(password) ||
       !number.test(password) ||
       !special.test(password)) {

        document.getElementById("passwordError").innerHTML =
        "Password must contain 8 characters, uppercase, lowercase, number and special character";

        validatePassword2();
        return false;
    }
    else {
        document.getElementById("passwordError").innerHTML = "";

        validatePassword2();
        return true;
    }
}


// Confirm Password Validation
function validatePassword2() {

    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;

    if(password2 == "" || password != password2) {
        document.getElementById("password2Error").innerHTML =
        "Confirm password does not match";
        return false;
    }
    else {
        document.getElementById("password2Error").innerHTML = "";
        return true;
    }
}


// Final Form Validation
function validate(ev) {

    let name = validateName();
    let gender = validateGender();
    let username = validateUsername();
    let email = validateEmail();
    let mobile = validateMobile();
    let dob = validateDOB();
    let country = validateCountry();
    let password = validatePassword();
    let password2 = validatePassword2();

    if(!name || !gender || !username || !email ||
       !mobile || !dob || !country || !password || !password2) {

        ev.preventDefault();
    }
}