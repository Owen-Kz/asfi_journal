// Import dependencies
import { parentDirectoryName, submissionsEndpoint } from "../constants.js";

// DOM Elements
const prefix = document.getElementById("prefix");
const registerForm = document.getElementById("registerForm");
const firstname = document.getElementById("first_name");
const lastname = document.getElementById("last_name");
const othername = document.getElementById("other_name");
const email = document.getElementById("email");
const affiliation = document.getElementById("affiliation");
const affiliation_country = document.getElementById("affiliation_country");
const affiliation_city = document.getElementById("affiliation_city");
const password = document.getElementById("password");
const disciplineMain = document.querySelector(".discipline");
const discipline = document.querySelector('#discipline');
const orcid = document.getElementById("orcid");
const disciplineContainer = document.getElementById("disciplineContainer");
const password2 = document.getElementById("password2");
const message_container = document.getElementById("message_container");
const body = document.querySelector("body");
const submitButton = document.getElementById("submitButton");

// Global state
let isFormSubmitting = false;
let recaptchaVerified = false;

// Initialize form
function initializeForm() {
    // Set initial form state
    body.setAttribute("id", "formNotSubmitted");
    
    // Discipline change handler
    if (discipline) {
        discipline.addEventListener("change", handleDisciplineChange);
    }
    
    // Password validation
    if (password && password2) {
        password.addEventListener("input", validatePassword);
        password2.addEventListener("input", validatePassword);
    }
    
    // Form submission
    if (registerForm) {
        registerForm.addEventListener("submit", handleFormSubmit);
    }
    
    // Expose functions to global scope for reCAPTCHA
    window.onRecaptchaSuccess = onRecaptchaSuccess;
    window.onRecaptchaExpired = onRecaptchaExpired;
    window.onRecaptchaError = onRecaptchaError;
    window.resetRecaptcha = resetRecaptcha;
}

// Handle discipline change
function handleDisciplineChange() {
    if (discipline.value.toLowerCase() === "other") {
        discipline.removeAttribute("name");
        disciplineContainer.innerHTML = `
            <input type="text" name="discipline" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-asfi-blue focus:border-asfi-blue transition-colors" 
                placeholder="Please specify your discipline" 
                required>
        `;
    } else {
        if (!discipline.hasAttribute("name")) {
            discipline.setAttribute("name", "discipline");
        }
        disciplineContainer.innerHTML = "";
    }
}

// Validate password
function validatePassword() {
    const passwordValue = password.value;
    const password2Value = password2.value;
    
    // Clear previous messages
    message_container.innerHTML = "";
    
    // Check if passwords match
    if (passwordValue && password2Value && passwordValue !== password2Value) {
        showMessage("Passwords do not match", "error");
        return false;
    }
    
    // Check password strength
    if (passwordValue && passwordValue.length < 8) {
        showMessage("Password must be at least 8 characters long", "error");
        return false;
    }
    
    // Check for password complexity
    if (passwordValue) {
        const hasUpperCase = /[A-Z]/.test(passwordValue);
        const hasLowerCase = /[a-z]/.test(passwordValue);
        const hasNumbers = /\d/.test(passwordValue);
        
        if (!hasUpperCase || !hasLowerCase || !hasNumbers) {
            showMessage("Password must contain uppercase, lowercase letters and numbers", "error");
            return false;
        }
    }
    
    return true;
}

// Show message
function showMessage(message, type = "error") {
    message_container.innerHTML = `
        <div class="alert-${type} fade-in">
            ${message}
        </div>
    `;
    
    // Auto-hide success messages after 5 seconds
    if (type === "success") {
        setTimeout(() => {
            message_container.innerHTML = "";
        }, 5000);
    }
}

// Handle form submission
async function handleFormSubmit(e) {
    e.preventDefault();
    
    // Prevent multiple submissions
    if (isFormSubmitting) {
        return;
    }
    
    // Check reCAPTCHA
    if (!recaptchaVerified) {
        showMessage("Please complete the reCAPTCHA verification", "error");
        iziToast.error({
            message: "Please complete the reCAPTCHA verification",
            position: "topRight"
        });
        return;
    }
    
    // Validate password
    if (!validatePassword()) {
        return;
    }
    
    // Get form values
    const availableForReview = document.querySelector('input[name="review"]:checked');
    
    // Validate required fields
    if (!email.value || !firstname.value || !lastname.value || !affiliation.value) {
        showMessage("Please fill in all required fields", "error");
        return;
    }
    
    // Set submitting state
    setSubmittingState(true);
    
    try {
        // Get reCAPTCHA response
        const recaptchaResponse = grecaptcha.getResponse();
        
        if (!recaptchaResponse) {
            throw new Error("reCAPTCHA verification failed");
        }
        
        // Prepare form data
        const formData = {
            prefix: prefix.value,
            firstname: firstname.value.trim(),
            lastname: lastname.value.trim(),
            othername: othername.value.trim(),
            orcid: orcid.value.trim(),
            discipline: getDisciplineValue(),
            email: email.value.trim(),
            affiliations: affiliation.value.trim(),
            affiliations_country: affiliation_country.value.trim(),
            affiliations_city: affiliation_city.value.trim(),
            password: password.value,
            availableForReview: availableForReview ? availableForReview.value : "no",
            'g-recaptcha-response': recaptchaResponse
        };
        
        // Submit form
        const response = await fetch(`https://greek.asfirj.org/backend/accounts/signup.php`, {
            method: "POST",
            body: JSON.stringify(formData),
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            credentials: "same-origin"
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.status === "success") {
            // Show success message
            showMessage(data.message, "success");
            iziToast.success({
                message: data.message,
                position: "topRight"
            });
            
            // Reset form
            registerForm.reset();
            resetRecaptcha();
            
            // Redirect to login page after 3 seconds
            setTimeout(() => {
                window.location.href = '../login/';
            }, 3000);
            
        } else {
            throw new Error(data.message || "Registration failed");
        }
        
    } catch (error) {
        console.error('Registration error:', error);
        
        // Show error message
        showMessage(error.message || "An error occurred during registration. Please try again.", "error");
        iziToast.error({
            message: error.message || "An error occurred during registration. Please try again.",
            position: "topRight"
        });
        
        // Reset reCAPTCHA on error
        resetRecaptcha();
        
    } finally {
        // Reset submitting state
        setSubmittingState(false);
    }
}

// Get discipline value based on selection
function getDisciplineValue() {
    if (discipline.value.toLowerCase() === "other") {
        const customDiscipline = document.querySelector('input[name="discipline"]');
        return customDiscipline ? customDiscipline.value : "";
    }
    return disciplineMain.value;
}

// Set submitting state
function setSubmittingState(submitting) {
    isFormSubmitting = submitting;
    
    if (submitButton) {
        if (submitting) {
            submitButton.innerHTML = `<span class="button-loader"></span> Processing...`;
            submitButton.disabled = true;
            submitButton.classList.add('btn-disabled');
        } else {
            submitButton.innerHTML = `Create Account`;
            submitButton.disabled = !recaptchaVerified;
            if (!recaptchaVerified) {
                submitButton.classList.add('btn-disabled');
            } else {
                submitButton.classList.remove('btn-disabled');
            }
        }
    }
}

// reCAPTCHA success callback
function onRecaptchaSuccess(response) {
    recaptchaVerified = true;
    setSubmittingState(false);
}

// reCAPTCHA expired callback
function onRecaptchaExpired() {
    recaptchaVerified = false;
    setSubmittingState(false);
    iziToast.warning({
        message: "reCAPTCHA verification expired. Please complete it again.",
        position: "topRight"
    });
}

// reCAPTCHA error callback
function onRecaptchaError() {
    recaptchaVerified = false;
    setSubmittingState(false);
    iziToast.error({
        message: "reCAPTCHA verification failed. Please try again.",
        position: "topRight"
    });
}

// Reset reCAPTCHA
function resetRecaptcha() {
    if (typeof grecaptcha !== 'undefined' && grecaptcha.reset) {
        grecaptcha.reset();
    }
    recaptchaVerified = false;
    setSubmittingState(false);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initializeForm);

// Export functions for testing or external use
export {
    initializeForm,
    handleDisciplineChange,
    validatePassword,
    handleFormSubmit,
    onRecaptchaSuccess,
    onRecaptchaExpired,
    onRecaptchaError,
    resetRecaptcha
};