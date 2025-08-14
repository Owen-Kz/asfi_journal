import { parentDirectoryName, submissionsEndpoint } from "../constants.js"

const prefix = document.getElementById("prefix")
const registerForm = document.getElementById("registerForm")
const firstname = document.getElementById("first_name")
const lastname = document.getElementById("last_name")
const othername = document.getElementById("other_name")
const email = document.getElementById("email");
const affiliation = document.getElementById("affiliation")
const affiliation_country = document.getElementById("affiliation_country")
const affiliation_city = document.getElementById("affiliation_city")
const password = document.getElementById("password")
const disciplineMain = document.querySelector(".discipline")
const discipline = document.querySelector('#discipline')
const orcid = document.getElementById("orcid");
if (discipline) {
    discipline.addEventListener("change", function () {
        if (discipline.value == "other" || discipline.value == "Other") {
            discipline.removeAttribute("name")
            disciplineContainer.innerHTML = `<input class='form-control discipline' name="discipline" placeholder="Specify Your discipline" required/>`
        } else {
            if (discipline.hasAttribute("name")) {

            } else {
                discipline.setAttribute("name", "discipline")
            }
            disciplineContainer.innerHTML = ""
        }
    })
}
const password2 = document.getElementById("password2")

const message_container = document.getElementById("message_container")
const body = document.querySelector("body")
body.setAttribute("id", "formNotSubmitted")
password.addEventListener("keyup", function () {
    if (!password.value) {
        message_container.innerHTML = `<div class="alert-danger">Password Can not be empty</div>`
    } else if (password.value != password2.value) {
        message_container.innerHTML = `<div class="alert-danger">Passwords do not match</div>`
    } else {
        message_container.innerHTML = ``
    }
})
password2.addEventListener("keyup", function () {
    if (!password.value) {
        message_container.innerHTML = `<div class="alert-danger">Password Can not be empty</div>`
    } else if (password.value != password2.value) {
        message_container.innerHTML = `<div class="alert-danger">Passwords do not match</div>`
    } else {
        message_container.innerHTML = ``
    }
})

registerForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const availableForReview = document.querySelector('input[name="review"]:checked');
    const submitButton = document.querySelector('.signin-btn');

    // Show loader and disable button
    submitButton.innerHTML = `<span class="button-loader"></span> Processing...`;
    submitButton.disabled = true;

    if (!password.value) {
        message_container.innerHTML = `<div class="alert-danger">Password Can not be empty</div>`;
        submitButton.innerHTML = `Submit`;
        submitButton.disabled = false;
    } else if (password.value != password2.value) {
        message_container.innerHTML = `<div class="alert-danger">Passwords do not match</div>`;
        submitButton.innerHTML = `Submit`;
        submitButton.disabled = false;
    } else if (password.value && password.value == password2.value && email.value) {
        const formData = {
            prefix: prefix.value,
            firstname: firstname.value,
            lastname: lastname.value,
            othername: othername.value,
            orcid: orcid.value,
            discipline: disciplineMain.value,
            email: email.value,
            affiliations: affiliation.value,
            affiliations_country: affiliation_country.value,
            affiliations_city: affiliation_city.value,
            password: password.value,
            availableForReview: availableForReview.value
        }
        body.removeAttribute("id");

        fetch(`https://greek.asfirj.org/backend/accounts/signup.php`, {
            method: "POST",
            body: JSON.stringify(formData),
            headers: {
                "Content-type": "application/JSON"
            }
        }).then(res => res.json())
            .then(data => {
                // Reset button state
                submitButton.innerHTML = `Submit`;
                submitButton.disabled = false;

                if (data) {
                    if (data.status === "error") {
                        message_container.innerHTML = `<div class="alert-danger">${data.message}</div>`;
                        iziToast.error({
                            message: data.message,
                            position: "topRight"
                        })
                        body.setAttribute("id", "formNotSubmitted");
                    } else if (data.status === "success") {
                        message_container.innerHTML = `<div class="alert-success">${data.message}</div>`;
                        iziToast.success({
                            message: data.message,
                            position: "topRight"
                        })
                        body.setAttribute("id", "formNotSubmitted");
                    } else {
                        console.log(data.message);
                        body.setAttribute("id", "formNotSubmitted");
                    }
                } else {
                    message_container.innerHTML = `<div class="alert-danger">Internal Server Error</div>`;
                }
            })
            .catch(error => {
                // Reset button state on error
                submitButton.innerHTML = `Submit`;
                submitButton.disabled = false;
                console.error('Error:', error);
                message_container.innerHTML = `<div class="alert-danger">Network error occurred</div>`;
            });
    }
});

// Add CSS for the loader
const loaderStyle = document.createElement('style');
loaderStyle.textContent = `
    .button-loader {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
        vertical-align: middle;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .signin-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
`;
document.head.appendChild(loaderStyle);