document.addEventListener("DOMContentLoaded", function () {
    const idInput = document.getElementById('id_user');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const registerForm = document.getElementById('registerForm');

    const idErrorMsg = document.getElementById('idErrorMessage');
    const emailErrorMsg = document.getElementById('emailErrorMessage');
    const passwordErrorMsg = document.getElementById('passwordErrorMessage');
    const passwordConfirmationErrorMsg = document.getElementById('passwordConfirmationErrorMessage');

    const emailRegex = /^[a-zA-Z0-9._%+-]+@student\.unud\.ac\.id$/;

    function validateId() {
        const id = idInput.value;
        let errors = []
        
        if (!/^[0-9]{2}08561[0-9]{3}$/.test(id)) errors.push("xx08561xxx format")
        if (id.length < 10) errors.push("10 digits");
        if (!/^\d+$/.test(id)) errors.push("numeric only");
        if (errors.length > 0) {
            idInput.classList.remove('border-gray-200');
            idInput.classList.add('border-red-500');
            idErrorMsg.innerText = "Id must contain: " + errors.join(", ");
            return false;
        } else {
            idInput.classList.remove('border-red-500');
            idInput.classList.add('border-gray-200');
            idErrorMsg.innerText = "";
            return true;
        }
    }

    function validateEmailField() {
        const email = emailInput.value;
        if (!emailRegex.test(email)) {
            emailInput.classList.remove('border-gray-200');
            emailInput.classList.add('border-red-500');
            emailErrorMsg.innerText = "Email must end with @student.unud.ac.id";
            return false;
        } else {
            emailInput.classList.remove('border-red-500');
            emailInput.classList.add('border-gray-200');
            emailErrorMsg.innerText = "";
            return true;
        }
    }

    function validatePasswordField() {
        const password = passwordInput.value;
        let errors = [];

        if (!/[a-z]/.test(password)) errors.push("1 Lower Case");
        if (!/[A-Z]/.test(password)) errors.push("1 Upper Case");
        if (!/\d/.test(password)) errors.push("1 Number");
        if (!/[^A-Za-z\d]/.test(password)) errors.push("1 Special Character");
        if (password.length < 8) errors.push("8 Characters long");

        if (errors.length > 0) {
            passwordInput.classList.remove('border-gray-200');
            passwordInput.classList.add('border-red-500');
            passwordErrorMsg.innerText = "Password must contain: " + errors.join(", ");
            return false;
        } else {
            passwordInput.classList.remove('border-red-500');
            passwordInput.classList.add('border-gray-200');
            passwordErrorMsg.innerText = "";
            return true;
        }
    }

    function validatePasswordConfirmation() {
        const passwordConfirmation = passwordConfirmationInput.value;

        if (passwordConfirmation != passwordInput.value) {
            passwordConfirmationInput.classList.remove('border-gray-200');
            passwordConfirmationInput.classList.add('border-red-500');
            passwordConfirmationErrorMsg.innerText = "Password confirmation needs to have the same value as password";
            return false;
        } else {
            passwordConfirmationInput.classList.remove('border-red-500');
            passwordConfirmationInput.classList.add('border-gray-200');
            passwordConfirmationErrorMsg.innerText = "";
            return true;
        }
    }

    // Real-time validation
    idInput.addEventListener('input', validateId);
    emailInput.addEventListener('input', validateEmailField);
    passwordInput.addEventListener('input', validatePasswordField);
    passwordConfirmationInput.addEventListener('input', validatePasswordConfirmation);

    // Final form submission check
    registerForm.addEventListener('submit', function (event) {
        const idValid = validateId();
        const emailValid = validateEmailField();
        const passwordValid = validatePasswordField();
        const passwordConfirmationValid = validatePasswordConfirmation();

        if (!idValid || !emailValid || !passwordValid || !passwordConfirmationValid) {
            event.preventDefault(); // Stop form submission
        }
    });
});