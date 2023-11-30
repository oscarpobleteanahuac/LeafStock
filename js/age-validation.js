// This script handles age validation
// Used in signup page
document.addEventListener("DOMContentLoaded", function () {
    const birthdateInput = document.getElementById("birthdate");

    birthdateInput.addEventListener("change", function () {
        const birthdate = new Date(birthdateInput.value);
        const currentDate = new Date();
        const age = currentDate.getFullYear() - birthdate.getFullYear();

        if (age < 18) {
            alert("You must be 18 years or older to sign up.");
            birthdateInput.value = "";
        }
    });
});