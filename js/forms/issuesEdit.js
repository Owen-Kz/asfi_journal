import { EndPoint, searchParams } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { quill, quill2 } from "./quill.js";

const articleEdit = `<div id="editorModal1" class="modal"><div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="editor-info">
                <form id="editArticle" onsubmit="return false" enctype="multipart/form-data">
                    <input type="hidden" id="token" name="token">
                    <div>
                        <label for="">Title:</label>
                        <input type="text" class="form-control" placeholder="" name="title" id="title" required>
                    </div>
                    
                    <div>
                        <label for="">Author(s):</label>
                    </div>
                    <div class="group" id="app_2">	
                        <div id="app">
                            <input type="text" id="authorsArray" name="authorsArray" class="form-control" v-model="saisie" placeholder="" required/>                                
                            <div class="keywords">
                                <div class="keyword" v-for="(k, i) in keywords">
                                    {{ k }}
                                    <span v-on:click="removeFromArray(i, k)"><i class="fas fa-times"></i></span>
                                </div>		
                            </div>
                        </div>

                        <div>
                            <label for="">Corresponding Authors Email:</label>
                            <input type="email" class="form-control" placeholder="" name="corresponding_author" id="corresponding_author" required>
                        </div>
                    </div>
                    <br>
                    <div>
                        <label for="">Cover Image:</label>
                        <input type="file" class="form-control" accept="image/*" name="manuscriptCover" id="manuscriptCover">
                        <div class="cover-preview-container">
                            <img id="coverPreview" class="cover-preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;">
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <label for="">Abstract Contents</label>
                        <div class="bg-body border rounded-bottom h-400px overflow-hidden" id="quilleditor2" style="height: 500px;"></div>
                    </div> 
                    <br>
                    <div class="col-12">
                        <label for="">Manuscript Contents</label>
                        <div class="bg-body border rounded-bottom h-400px overflow-hidden" id="quilleditor" style="height: 500px;"></div>
                    </div>
                    <br>
                    <input type="submit" class="signin-btn" value="Submit" id="submitButton">
                </form>
            </div>
        </div>
    </div>`;

// Modal functions and variables
var modal1 = document.getElementById("editorModal1");
var modal2 = document.getElementById("editorModal2");
var span = document.getElementsByClassName("close")[0];

function openModal() { modal1.classList.add("show"); }
function openModal2() { modal2.classList.add("show"); }
function closeModal() { modal1.classList.remove("show"); }
function closeModal2() { modal2.classList.remove("show"); }

window.onclick = function(event) {
    if (event.target == modal1) closeModal();
    if (event.target == modal2) closeModal2();
};

// DOM elements
const ArticleId = searchParams.get("a_id");
const ArticleTitle = searchParams.get("edit");
const token = document.getElementById("token");
const title = document.getElementById("title");
const corresponsfinAuthor = document.getElementById("corresponding_author");
const AuthorsArray = document.getElementById("authorsArray");
const coverPreview = document.getElementById("coverPreview");
const manuscriptCoverInput = document.getElementById("manuscriptCover");

// Cover image preview handler
if (manuscriptCoverInput && coverPreview) {
    manuscriptCoverInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                coverPreview.src = event.target.result;
                coverPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            coverPreview.style.display = 'none';
        }
    });
}

if (ArticleId && ArticleTitle) {
    openModal();
    fetch(`${EndPoint}/retrieveArticle.php?q=${ArticleId}&title=${ArticleTitle}`, {
        method: "GET"
    }).then(res => res.json())
    .then(data => {
        if (data.articleData) {
            const Article = data.articleData;
            if (Article.length > 0) {
                const article = Article[0];
                
                // Set basic fields
                corresponsfinAuthor.value = article.corresponding_authors_email || "";
                title.value = article.manuscript_full_title || "";
                token.value = article.buffer || "";
                
                // Show existing cover image if available
                if (article.manuscriptPhoto && article.manuscriptPhoto !== "cover.jpg") {
                    coverPreview.src = `https://asfirj.org/useruploads/article_images/${article.manuscriptPhoto}`;
                    coverPreview.style.display = 'block';
                }

                // Get authors
                fetch(`${EndPoint}/allAuthors.php?articleID=${article.buffer}`, {
                    method: "GET"
                }).then(res => res.json())
                .then(authorData => {
                    if (authorData && authorData.authorsList) {
                        const authorsName = authorData.authorsList
                            .map(author => author.authors_fullname)
                            .join(",");
                        AuthorsArray.value = authorsName;
                    }
                }).catch(err => console.error("Error fetching authors:", err));

                // Set Quill content with error handling
                try {
                    const quillContent = article.unstructured_abstract ? 
                        JSON.parse(article.unstructured_abstract) : 
                        { ops: [{ insert: "\n" }] };
                    const quillContent2 = article.abstract_discussion ? 
                        JSON.parse(article.abstract_discussion) : 
                        { ops: [{ insert: "\n" }] };

                    // Wait for Quill to be ready
                    const quillCheckInterval = setInterval(() => {
                        if (quill && quill2) {
                            clearInterval(quillCheckInterval);
                            quill.setContents(quillContent);
                            quill2.setContents(quillContent2);
                        }
                    }, 100);
                } catch (e) {
                    console.error("Error parsing Quill content:", e);
                    quill.setContents({ ops: [{ insert: "\n" }] });
                    quill2.setContents({ ops: [{ insert: "\n" }] });
                }
            } else {
                // alert("Article not found on server");
                iziToast.error({
                    message:"Article not found on server",
                    position:"topRight"
                })
            }
        } else {
            // alert(data.message || "Error retrieving article data");
               iziToast.error({
                    message:data.message || "Error retrieving article data",
                    position:"topRight"
                })
        }
    }).catch(error => {
        console.error("Fetch error:", error);
            iziToast.error({
                    message: "Error connecting to server",
                    position:"topRight"
                })
        
    });
}

// Form submission
const EditArticleForm = document.getElementById('editArticle');
if (EditArticleForm) {
    EditArticleForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(EditArticleForm);
        
        // Add Quill content with error handling
        try {
            formData.append('article_content', JSON.stringify(quill.getContents()));
            formData.append('abstract_discussion', JSON.stringify(quill2.getContents()));
        } catch (e) {
            console.error("Error getting Quill content:", e);
                 iziToast.error({
                    message: "Error preparing article content",
                    position:"topRight"
                })
            return;
        }

        const body = document.querySelector("body");
        body.removeAttribute("id");

        fetch(`${EndPoint}/editManuscript.php`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            if (data.status === "success") {
              iziToast.success({
    message: "Article Edited Successfully",
    position: "topRight",
    onClosed: function() {
        window.location.href = "../manage";
    }
});
            } else {
                        iziToast.error({
                    message: data.message || "Error updating article",
                    position:"topRight"
                })
                body.setAttribute("id", "formNotSubmitted");
            }
        })
        .catch(error => {
            console.error('Error:', error);
                    iziToast.error({
                    message: "Network error occurred. Please try again.",
                    position:"topRight"
                })
        });
    });
}

// Add styles for cover preview
const style = document.createElement('style');
style.textContent = `
    .cover-preview-container {
        margin-top: 10px;
    }
    .cover-preview {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        background: #f8f9fa;
    }
`;
document.head.appendChild(style);