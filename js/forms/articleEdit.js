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
window.onclick = function (event) {
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
const manuscriptFileInput = document.getElementById("manuscript_file");

// Create cover image preview container
const coverPreviewContainer = document.createElement('div');
coverPreviewContainer.className = 'cover-preview-container';
coverPreviewContainer.innerHTML = `
    <div class="existing-file-info" id="existingCoverInfo" style="display: none;">
        <p><strong>Current Cover Image:</strong></p>
        <img class="cover-preview" id="existingCoverPreview" style="max-width: 200px; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
        <button type="button" class="btn-remove-file" id="removeCoverBtn" style="margin-top: 10px; padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Remove Cover Image</button>
    </div>
    <div class="new-file-preview" id="newCoverPreview" style="display: none;">
        <p><strong>New Cover Image Preview:</strong></p>
        <img class="cover-preview" id="newCoverPreviewImg" style="max-width: 200px; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
    </div>
`;

// Create manuscript file preview container
const manuscriptPreviewContainer = document.createElement('div');
manuscriptPreviewContainer.className = 'manuscript-preview-container';
manuscriptPreviewContainer.innerHTML = `
    <div class="existing-file-info" id="existingManuscriptInfo" style="display: none;">
        <p><strong>Current Manuscript File:</strong> <span id="existingManuscriptName"></span></p>
        <div style="display: flex; gap: 10px; margin-top: 10px;">
            <a href="#" id="viewManuscriptLink" target="_blank" class="btn-view-file" style="padding: 5px 10px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 4px;">View Current File</a>
            <button type="button" class="btn-remove-file" id="removeManuscriptBtn" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Remove Manuscript File</button>
        </div>
    </div>
    <div class="new-file-info" id="newManuscriptInfo" style="display: none; margin-top: 10px;">
        <p><strong>New File Selected:</strong> <span id="newManuscriptName"></span></p>
    </div>
`;

// Add containers after inputs
if (manuscriptCoverInput) {
    manuscriptCoverInput.insertAdjacentElement('afterend', coverPreviewContainer);
}

if (manuscriptFileInput) {
    manuscriptFileInput.insertAdjacentElement('afterend', manuscriptPreviewContainer);
}

// Track files to remove
let removeCover = false;
let removeManuscript = false;

// Handle cover image preview for new selection
if (manuscriptCoverInput) {
    manuscriptCoverInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        const newPreview = document.getElementById('newCoverPreview');
        const newPreviewImg = document.getElementById('newCoverPreviewImg');
        const existingInfo = document.getElementById('existingCoverInfo');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                newPreviewImg.src = event.target.result;
                newPreview.style.display = 'block';
                // Hide existing preview if showing
                if (existingInfo.style.display === 'block') {
                    existingInfo.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        } else {
            newPreview.style.display = 'none';
            // Show existing preview again if file exists and not removed
            if (!removeCover && existingInfo.getAttribute('data-has-file') === 'true') {
                existingInfo.style.display = 'block';
            }
        }
    });
}

// Handle manuscript file selection
if (manuscriptFileInput) {
    manuscriptFileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        const newInfo = document.getElementById('newManuscriptInfo');
        const newName = document.getElementById('newManuscriptName');
        const existingInfo = document.getElementById('existingManuscriptInfo');
        
        if (file) {
            newName.textContent = file.name;
            newInfo.style.display = 'block';
            // Hide existing info if showing
            if (existingInfo.style.display === 'block') {
                existingInfo.style.display = 'none';
            }
        } else {
            newInfo.style.display = 'none';
            // Show existing info again if file exists and not removed
            if (!removeManuscript && existingInfo.getAttribute('data-has-file') === 'true') {
                existingInfo.style.display = 'block';
            }
        }
    });
}

// Handle remove cover button
document.addEventListener('click', function(e) {
    if (e.target.id === 'removeCoverBtn') {
        e.preventDefault();
        removeCover = true;
        document.getElementById('existingCoverInfo').style.display = 'none';
        manuscriptCoverInput.value = ''; // Clear file input
        document.getElementById('newCoverPreview').style.display = 'none';
        
        // Add hidden input to indicate cover should be removed
        let removeField = document.getElementById('remove_cover_field');
        if (!removeField) {
            removeField = document.createElement('input');
            removeField.type = 'hidden';
            removeField.name = 'remove_cover';
            removeField.id = 'remove_cover_field';
            removeField.value = 'true';
            manuscriptCoverInput.parentNode.appendChild(removeField);
        }
        
        iziToast.info({
            message: "Cover image will be removed on save",
            position: "topRight"
        });
    }
});

// Handle remove manuscript button
document.addEventListener('click', function(e) {
    if (e.target.id === 'removeManuscriptBtn') {
        e.preventDefault();
        removeManuscript = true;
        document.getElementById('existingManuscriptInfo').style.display = 'none';
        manuscriptFileInput.value = ''; // Clear file input
        document.getElementById('newManuscriptInfo').style.display = 'none';
        
        // Add hidden input to indicate manuscript should be removed
        let removeField = document.getElementById('remove_manuscript_field');
        if (!removeField) {
            removeField = document.createElement('input');
            removeField.type = 'hidden';
            removeField.name = 'remove_manuscript';
            removeField.id = 'remove_manuscript_field';
            removeField.value = 'true';
            manuscriptFileInput.parentNode.appendChild(removeField);
        }
        
        iziToast.info({
            message: "Manuscript file will be removed on save",
            position: "topRight"
        });
    }
});

if (ArticleId && ArticleTitle) {
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
                    const existingCoverInfo = document.getElementById('existingCoverInfo');
                    const existingCoverPreview = document.getElementById('existingCoverPreview');
                    
                    if (manuscriptPhoto && manuscriptPhoto !== "cover.jpg" && manuscriptPhoto !== "") {
                        existingCoverPreview.src = `https://asfirj.org/useruploads/article_images/${manuscriptPhoto}`;
                        existingCoverInfo.style.display = 'block';
                        existingCoverInfo.setAttribute('data-has-file', 'true');
                    } else {
                        existingCoverInfo.setAttribute('data-has-file', 'false');
                    }

                    // Display current manuscript file if exists
                    const existingManuscriptInfo = document.getElementById('existingManuscriptInfo');
                    const existingManuscriptName = document.getElementById('existingManuscriptName');
                    const viewManuscriptLink = document.getElementById('viewManuscriptLink');
                    
                    if (ManuscriptFile && ManuscriptFile !== "") {
                        existingManuscriptName.textContent = ManuscriptFile;
                        viewManuscriptLink.href = `https://asfirj.org/useruploads/manuscripts/${ManuscriptFile}`;
                        existingManuscriptInfo.style.display = 'block';
                        existingManuscriptInfo.setAttribute('data-has-file', 'true');
                    } else {
                        existingManuscriptInfo.setAttribute('data-has-file', 'false');
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
                    iziToast.error({
                        message: "File Not found on server",
                        position: "topRight"
                    })
                }
            } else {
                iziToast.error({
                    message: data.message || "Error retrieving article data",
                    position: "topRight"
                })
            }
        }).catch(error => {
            console.error("Fetch error:", error);
            iziToast.error({
                message: "Error connecting to server",
                position: "topRight"
            })
        });
}

// Finally Submit and Edit the Article 
const EditArticleForm = document.getElementById('editArticle');
if (EditArticleForm) {
    EditArticleForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(EditArticleForm);

        // Add Quill content to form data
        if (quill) {
            formData.append('article_content', JSON.stringify(quill.getContents()));
        }
        if (quill2) {
            formData.append('article_abstract', JSON.stringify(quill2.getContents()));
        }

        // Only append files if they are selected
        if (manuscriptFileInput && manuscriptFileInput.files.length > 0) {
            formData.append('manuscript_file', manuscriptFileInput.files[0]);
        }
        
        if (manuscriptCoverInput && manuscriptCoverInput.files.length > 0) {
            formData.append('manuscriptCover', manuscriptCoverInput.files[0]);
        }

        const body = document.querySelector("body");
        body.removeAttribute("id");

        fetch(`${EndPoint}/editManuscript.php`, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    iziToast.success({
                        message: "Article Edited Successfully",
                        position: "topRight",
                        onClosed: function () {
                            window.location.href = "../manage";
                        }
                    });
                } else if (data.status === "error") {
                    iziToast.error({
                        message: data.message,
                        position: "topRight"
                    })
                    body.setAttribute("id", "formNotSubmitted");
                } else {
                    iziToast.error({
                        message: "Internal Server Error",
                        position: "topRight"
                    })
                    body.setAttribute("id", "formNotSubmitted");
                }
            })
            .catch(error => {
                console.error('Error:', error);

                iziToast.error({
                    message: "Network error occurred",
                    position: "topRight"
                })
            });
    });
}

// Add some basic styles for the preview
const style = document.createElement('style');
style.textContent = `
    .cover-preview-container, .manuscript-preview-container {
        display: block;
        margin-top: 15px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 4px;
    }
    .cover-preview {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        background: #fff;
    }
    .btn-remove-file {
        transition: background-color 0.3s ease;
    }
    .btn-remove-file:hover {
        background-color: #c82333 !important;
    }
    .btn-view-file {
        transition: background-color 0.3s ease;
    }
    .btn-view-file:hover {
        background-color: #0056b3 !important;
    }
    .existing-file-info, .new-file-info {
        padding: 10px;
        background: #fff;
        border-radius: 4px;
        margin-bottom: 10px;
    }
`;
document.head.appendChild(style);