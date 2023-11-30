document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const inputFields = document.querySelectorAll('.form-control');
    const showHideIcons = document.querySelectorAll('.show-hide-password');
    let originalFormValues = {};
    let changesMade = false;

    function toggleReadOnly(element) {
        element.readOnly = !element.readOnly;
        changesMade = true;
    }

    function togglePasswordVisibility(icon) {
        const passwordField = icon.closest('.input-group').querySelector('input');
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        originalFormValues[passwordField.name] = passwordField.value;
        changesMade = true;
    }

    function recordOriginalValues() {
        inputFields.forEach(function (inputField) {
            originalFormValues[inputField.name] = inputField.value;
        });
    }

    function areFormValuesChanged() {
        let changesMade = false;
        inputFields.forEach(function (inputField) {
            if (inputField.type === 'password') {
                const passwordField = inputField.closest('.input-group').querySelector('input');
                if (passwordField.value !== originalFormValues[passwordField.name]) {
                    changesMade = true;
                }
            } else if (inputField.value !== originalFormValues[inputField.name]) {
                changesMade = true;
            }
        });
        return changesMade;
    }

    function displayAlert(message) {
        alert(message);
    }

    recordOriginalValues();

    inputFields.forEach(function (inputField) {
        inputField.addEventListener('input', function () {
            if (!areFormValuesChanged()) {
                changesMade = false;
                displayAlert("No changes were made.");
            } else {
                changesMade = true;
            }
        });

        inputField.addEventListener('click', function () {
            toggleReadOnly(this);
        });
    });

    showHideIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            togglePasswordVisibility(this);
        });
    });

    form.addEventListener('submit', function (event) {
        if (!areFormValuesChanged()) {
            displayAlert("No changes were made.");
            event.preventDefault();
        } else {
            displayAlert("Changes were successfully saved.");
            changesMade = false;
        }
    });

    window.addEventListener('beforeunload', function (event) {
        if (changesMade) {
            const message = 'You have unsaved changes. Are you sure you want to leave?';
            event.returnValue = message;
            displayAlert(message);
        }
    });
});
