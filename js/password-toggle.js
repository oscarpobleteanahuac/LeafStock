// Function to toggle the visibility of the password
// Used in login and signup pages
function togglePasswordVisibility(fieldId, eyeIconId) {
    var passwordInput = document.getElementById(fieldId);
    var eyeIcon = document.getElementById(eyeIconId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.className = "fa fa-eye-slash";
    } else {
        passwordInput.type = "password";
        eyeIcon.className = "fa fa-eye";
    }
}
