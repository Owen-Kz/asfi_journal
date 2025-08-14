import { EndPoint, searchParams } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { quill, quill2 } from "./quill.js";

// Get the modal
var modal1 = document.getElementById("editorModal1");
var modal2 = document.getElementById("editorModal2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Function to open the modal
function openModal() {
    modal1.classList.add("show"); // Add the 'show' class
}

function openModal2() {
    modal2.classList.add("show");
}

// Function to close the modal
function closeModal() {
    modal1.classList.remove("show"); // Remove the 'show' class
}

function closeModal2() {
    modal2.classList.remove("show"); // Remove the 'show' class
}

// Close the modal when the user clicks outside of it
window.onclick = function(event) {
    if (event.target == modal1) {
        closeModal();
    }
    if (event.target == modal2) {
        closeModal2();
    }
}

const ArticleId = searchParams.get("a_id");
const ArticleTitle = searchParams.get("edit");
const token = document.getElementById("token");
const title = document.getElementById("title");
const corresponsfinAuthor = document.getElementById("corresponding_author");
const AuthorsArray = document.getElementById("authorsArray");
const manuscriptCoverInput = document.getElementById("manuscriptCover");

// Create cover image preview element
const coverPreviewContainer = document.createElement('div');
coverPreviewContainer.className = 'cover-preview-container';
const coverPreview = document.createElement('img');
coverPreview.className = 'cover-preview';
coverPreview.style.maxWidth = '200px';
coverPreview.style.maxHeight = '200px';
coverPreview.style.marginTop = '10px';
coverPreview.style.display = 'none';
coverPreviewContainer.appendChild(coverPreview);

// Add preview container after the cover image input
if (manuscriptCoverInput) {
    manuscriptCoverInput.insertAdjacentElement('afterend', coverPreviewContainer);
}

// Handle cover image preview
if (manuscriptCoverInput) {
    manuscriptCoverInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                coverPreview.src = event.target.result;
                coverPreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            coverPreview.style.display = 'none';
        }
    });
}

if(ArticleId && ArticleTitle){
    openModal();
    // Find the Article to edit  
    fetch(`${EndPoint}/retrieveArticle.php?q=${ArticleId}&title=${ArticleTitle}`, {
        method: "GET"
    }).then(res => res.json())
    .then(data => {
        if (data.articleData) {
            const Article = data.articleData;

            if (Article.length > 0) {
                const ArticleTitle = Article[0].manuscript_full_title;
                const ManuscriptFile = Article[0].manuscript_file;
                const unstructuredAbstract = Article[0].unstructured_abstract;
                const abstractDiscussion = Article[0].abstract_discussion;
                const correspondingAuthorsEmail = Article[0].corresponding_authors_email;
                const manuscriptPhoto = Article[0].manuscriptPhoto;
                const buffer = Article[0].buffer;
                const DateUploaded = formatTimestamp(Article[0].date_uploaded);
                
                corresponsfinAuthor.value = correspondingAuthorsEmail;
                title.value = ArticleTitle;
                token.value = buffer;

                // Display current cover image if exists
                if (manuscriptPhoto && manuscriptPhoto !== "cover.jpg") {
                    coverPreview.src = `https://asfirj.org/useruploads/article_images/${manuscriptPhoto}`;
                    coverPreview.style.display = 'block';
                }

                // Get the authors 
                fetch(`${EndPoint}/allAuthors.php?articleID=${buffer}`, {
                    method: "GET"
                }).then(res => res.json())
                    .then(data => {
                        if (data) {
                            const AllAuthors = data.authorsList;
                            let AuthorsName = "";

                            AllAuthors.forEach(author => {
                                const AuthorsFullname = `${author.authors_fullname},`;
                                AuthorsName += AuthorsFullname;
                            });

                            AuthorsArray.value = AuthorsName;
                        } else {
                            console.log("Server Error");
                        }
                    });

                // Parse and set Quill content
                try {
                    const quillContent = unstructuredAbstract ? JSON.parse(unstructuredAbstract) : { ops: [] };
                    const quillContent2 = abstractDiscussion ? JSON.parse(abstractDiscussion) : { ops: [] };

                    // Ensure Quill editors are ready
                    const checkQuillReady = setInterval(() => {
                        if (quill && quill2) {
                            clearInterval(checkQuillReady);
                            quill.setContents(quillContent);
                            quill2.setContents(quillContent2);
                        }
                    }, 100);
                } catch (e) {
                    console.error("Error parsing Quill content:", e);
                    // Initialize with empty content if parsing fails
                    quill && quill.setContents({ ops: [] });
                    quill2 && quill2.setContents({ ops: [] });
                }

            } else {
                alert("File Not found on server");
            }
        } else {
            alert(data.message || "Error retrieving article data");
        }
    }).catch(error => {
        console.error("Fetch error:", error);
        alert("Error connecting to server");
    });
}

// Finally Submit and Edit the Article 
const EditArticleForm = document.getElementById('editArticle');
if (EditArticleForm) {
    EditArticleForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(EditArticleForm);
        
        // Add Quill content to form data
        if (quill) {
            formData.append('article_content', JSON.stringify(quill.getContents()));
        }
        if (quill2) {
            formData.append('article_abstract', JSON.stringify(quill2.getContents()));
        }
        
        const body = document.querySelector("body");
        body.removeAttribute("id");

        fetch(`${EndPoint}/editManuscript.php`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === "success"){
                alert("Article Edited Successfully");
                window.location.href = "../manage";
            } else if(data.status === "error"){
                alert(data.message);
                body.setAttribute("id", "formNotSubmitted");
            } else {
                alert("Internal Server Error");
                body.setAttribute("id", "formNotSubmitted");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Network error occurred");
        });
    });
}

// Add some basic styles for the preview
const style = document.createElement('style');
style.textContent = `
    .cover-preview-container {
        display: block;
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