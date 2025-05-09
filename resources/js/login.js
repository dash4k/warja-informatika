document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const registerForm = document.getElementById('loginForm');

    const emailErrorMsg = document.getElementById('emailErrorMessage');
    const passwordErrorMsg = document.getElementById('passwordErrorMessage');

    const emailRegex = /^[a-zA-Z0-9._%+-]+@student\.unud\.ac\.id$/;

    function validateEmailField() {
        const email = emailInput.value;
        if (!emailRegex.test(email)) {
            emailInput.classList.remove('border-gray-200');
            emailInput.classList.add('border-red-500');
            emailErrorMsg.innerText = "Invalid Email Format!";
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
        
        if (
            password.length < 8 || 
            !/[a-z]/.test(password) || 
            !/[A-Z]/.test(password) || 
            !/\d/.test(password) || 
            !/[^A-Za-z\d]/.test(password)) {
            passwordInput.classList.remove('border-gray-200');
            passwordInput.classList.add('border-red-500');
            passwordErrorMsg.innerText = "Invalid Password Format!";
            return false;
        } else {
            passwordInput.classList.remove('border-red-500');
            passwordInput.classList.add('border-gray-200');
            passwordErrorMsg.innerText = "";
            return true;
        }
    }

    // Real-time validation
    emailInput.addEventListener('input', validateEmailField);
    passwordInput.addEventListener('input', validatePasswordField);

    // Final form submission check
    registerForm.addEventListener('submit', function (event) {
        const emailValid = validateEmailField();
        const passwordValid = validatePasswordField();
       
        if (!emailValid || !passwordValid) {
            event.preventDefault(); // Stop form submission
        }
    });
});