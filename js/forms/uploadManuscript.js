import { EndPoint, submissionsEndpoint } from "../constants.js";
import { GetAccountData } from "../dashboards/accountData.js";
import { GetCookie } from "../setCookie.js";
import { quill } from "./quill.js";

const uploadForm = document.getElementById("uploadForm");
const body = document.querySelector("body")
const message_container = document.getElementById("message_container")
const user = GetCookie("user")
const UserData = await GetAccountData(user)
const disciplineContainer = document.getElementById("disciplineContainer")
const email = UserData.email 
const discipline = document.querySelector('#discipline')
discipline.addEventListener("change", function(){
    console.log(discipline.value)
    if(discipline.value == "other" || discipline.value == "Other"){
        console.log("VAlue")
        discipline.removeAttribute("name")
        disciplineContainer.innerHTML = `<input class='form-control' name="discipline" placeholder="Specify Your discipline" required/>`
    }else{
        if(discipline.hasAttribute("name")){

        }else{
            discipline.setAttribute("name", "discipline")
        }
        disciplineContainer.innerHTML = ""
    }
})
const emailContainer = document.getElementById("loggedIn_email")
const loggedContainer = document.getElementById("logged_email")

const prefix = document.getElementById("author_information_prefix")
const firstname = document.getElementById("loggedIn_firstname")
const lastname  = document.getElementById("loggedIn_lastname")
const othername = document.getElementById("loggedIn_othername")
const affiliation = document.getElementById("loggedIn_affiliation")
const affiliationCountry = document.getElementById("loggedIn_affiliation_country")
const affiliationCity = document.getElementById("loggedIn_affiliation_city")

firstname.value = UserData.firstname
prefix.value = UserData.prefix
lastname.value = UserData.lastname 
othername.value = UserData.othername
affiliation.value = UserData.affiliations
affiliationCountry.value = UserData.affiliation_country
affiliationCity.value = UserData.affiliation_city 
emailContainer.value = email 
loggedContainer.value = email

body.setAttribute("id", "formNotSubmitted")

uploadForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(uploadForm);
    formData.append('abstract', JSON.stringify(quill.getContents().ops));



    body.removeAttribute("id")
    // formData.append('article_content', JSON.stringify(quill.getContents().ops));
    // console.log(JSON.stringify(quill.getContents().ops))

    fetch(`${submissionsEndpoint}/submit/`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Log server response
        if(data.status === "success"){
            alert("Upload Successful")
            // window.location.href = "../supplements.html#supplements"
        }else if(data.status === "error"){
            alert(data.message)
            body.setAttribute("id", "formNotSubmitted")
        }else{
            alert("Internal Server Error")
            body.setAttribute("id", "formNotSubmitted")
        }

    })
    .catch(error => {
        console.error('Error:', error);
    });
});

