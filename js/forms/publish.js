import { EndPoint } from "../constants.js";
import { quill, quill2 } from "./quill.js";

const uploadForm = document.getElementById("uploadArticle");
const body = document.querySelector("body")

const articleTypeContainer = document.getElementById("articleTypeContainer")

const articleType = document.querySelector('#article_type')
articleType.addEventListener("change", function(){
    
    if(articleType.value == "other" || articleType.value == "Other"){
        articleType.removeAttribute("name")
        articleTypeContainer.innerHTML = `<input class='form-control' name="article_type" placeholder="Specify the manuscript type" required/>`
    }else{
        if(articleType.hasAttribute("name")){

        }else{
            articleType.setAttribute("name", "article_type")
        }
        articleTypeContainer.innerHTML = ""
    }
})

uploadForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(uploadForm);
    formData.append('article_content', JSON.stringify(quill.getContents().ops));
    formData.append('article_abstract', JSON.stringify(quill2.getContents().ops))


    body.removeAttribute("id")
    // formData.append('article_content', JSON.stringify(quill.getContents().ops));

    fetch(`${EndPoint}/publishManuscript.php`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success"){
            alert("Upload Successful")
            window.location.href = "../issues"
        }else if(data.status === "error"){
            alert(data.message)
            body.setAttribute("id", "formNotSubmitted")
        }else{
            alert("Internal Server Error")
            body.setAttribute("id", "formNotSubmitted")
        }

    })
    .catch(error => {
        alert(error)
        body.setAttribute("id", "formNotSubmitted")

        console.error('Error:', error);
    });
});




const qltoolbar = document.querySelectorAll(".ql-toolbar")

// qltoolbar[0].innerHTML += `  <button id="undo-button2" type="button" title="Undo"> <i class="bi bi-arrow-counterclockwise"></i>
//                                         </button>

//                                         <button id="redo-button2" type="button" title="Redo">
//                                             <i class="bi bi-arrow-clockwise"></i>
                                          
//                                         </button>` 
// qltoolbar[1].innerHTML += `  <button id="undo-button" type="button" title="Undo"> <i class="bi bi-arrow-counterclockwise"></i>
//                                         </button>

//                                         <button id="redo-button" type="button" title="Redo">
//                                             <i class="bi bi-arrow-clockwise"></i>
                                          
//                                         </button>`


    // Undo functionality
    document.getElementById('undo-button').addEventListener('click', function() {
        quill.history.undo();
    });
  
    // Redo functionality
    document.getElementById('redo-button').addEventListener('click', function() {
        quill.history.redo();
    });

    // Undo functionality
    document.getElementById('undo-button2').addEventListener('click', function() {
        quill2.history.undo();
    });
  
    // Redo functionality
    document.getElementById('redo-button2').addEventListener('click', function() {
        quill2.history.redo();
    });