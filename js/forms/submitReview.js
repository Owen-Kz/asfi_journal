import { GetParameters, parentDirectoryName, submissionsEndpoint } from "../constants.js";
import { GetAccountData } from "../dashboards/accountData.js";
import { GetCookie } from "../setCookie.js";


const uploadForm = document.getElementById("reviewForm");
const body = document.querySelector("body")

body.setAttribute("id", "formNotSubmitted")

const message_container = document.getElementById("message_container")
const id_container = document.getElementById("article_id")
const reviewebyContaier = document.getElementById("reviewed_by")

const articleId = GetParameters(window.location.href).get("a")
const userID = GetCookie("user")
const UserData = await GetAccountData(userID)
const user = UserData.email
            const overlayX = document.querySelector('.overlayX');

if (user && articleId) {
    const userData = await GetAccountData(userID)
    const email = userData.email

    id_container.value = articleId
    reviewebyContaier.value = email


    uploadForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(uploadForm);
                    overlayX.style.display = 'flex';


        // formData.append('article_content', JSON.stringify(quill.getContents().ops));
        // console.log(JSON.stringify(quill.getContents().ops))

        fetch(`https://greek.asfirj.org/review/`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                ; // Log server response
                if(!data){
                     message_container.innerHTML = `<div class="alert-success">Internal Server Error</div>`

                    overlayX.style.display = 'none';

                    // Simulate form submission
               return   setTimeout(function () {
                        overlayX.style.display = 'none';
                        document.getElementById('message_container').classList.remove('hidden');

                        // Scroll to message
                        document.getElementById('message_container').scrollIntoView({ behavior: 'smooth' });
                    }, 3000);
                    // window.
                }
                if (data.status === "success") {
                    message_container.innerHTML = `<div class="alert-success">${data.message}</div>`

                    overlayX.style.display = 'none';

                    // Simulate form submission
                    setTimeout(function () {
                        overlayX.style.display = 'none';
                        document.getElementById('message_container').classList.remove('hidden');

                        // Scroll to message
                        document.getElementById('message_container').scrollIntoView({ behavior: 'smooth' });
                    }, 3000);
                    // window.location.href = "/dashboard/reviewerdash"
                } else if (data.status === "error") {
                    message_container.innerHTML = `<div class="alert-danger">${data.message}</div>`

                    overlayX.style.display = 'none';
                    setTimeout(function () {
                        overlayX.style.display = 'none';
                        document.getElementById('message_container').classList.remove('hidden');

                        // Scroll to message
                        document.getElementById('message_container').scrollIntoView({ behavior: 'smooth' });
                    }, 3000);
                } else {
                    message_container.innerHTML = `<div class="alert-danger">Internal Server Error</div>`

                    overlayX.style.display = 'none';
                    setTimeout(function () {
                        overlayX.style.display = 'none';
                        document.getElementById('message_container').classList.remove('hidden');

                        // Scroll to message
                        document.getElementById('message_container').scrollIntoView({ behavior: 'smooth' });
                    }, 3000);

                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

} else {
    window.location.href = `${parentDirectoryName}/dashboard/reviewerdash`
}