import { EndPoint, searchParams } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { quill, quill2 } from "./quill.js";

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

// Navigation functions
window.nextStep = function(currentStep) {
    if (validateStep(currentStep)) {
        document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
        document.querySelector(`.progress-steps .step[data-step="${currentStep}"]`).classList.remove('active');
        
        document.querySelector(`.form-step[data-step="${currentStep + 1}"]`).classList.add('active');
        document.querySelector(`.progress-steps .step[data-step="${currentStep + 1}"]`).classList.add('active');
    }
};

window.prevStep = function(currentStep) {
    document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
    document.querySelector(`.progress-steps .step[data-step="${currentStep}"]`).classList.remove('active');
    
    document.querySelector(`.form-step[data-step="${currentStep - 1}"]`).classList.add('active');
    document.querySelector(`.progress-steps .step[data-step="${currentStep - 1}"]`).classList.add('active');
};

function validateStep(step) {
    if (step === 1) {
        const title = document.getElementById('title').value;
        const authors = document.getElementById('authorsArray').value;
        const email = document.getElementById('corresponding_author').value;
        
        if (!title || !authors || !email) {
            iziToast.error({
                message: "Please fill in all required fields",
                position: "topRight"
            });
            return false;
        }
        
        if (!email.includes('@') || !email.includes('.')) {
            iziToast.error({
                message: "Please enter a valid email address",
                position: "topRight"
            });
            return false;
        }
    }
    return true;
}

// DOM elements
const ArticleId = searchParams.get("a_id");
const ArticleTitle = searchParams.get("edit");
const token = document.getElementById("token");
const title = document.getElementById("title");
const corresponsfinAuthor = document.getElementById("corresponding_author");
const AuthorsArray = document.getElementById("authorsArray");
const manuscriptCoverInput = document.getElementById("manuscriptCover");
const manuscriptFileInput = document.getElementById("manuscript_file");

console.log("Article ID from URL:", ArticleId);
console.log("Article Title from URL:", ArticleTitle);

// Create cover image preview container with existing file display
const coverPreviewContainer = document.createElement('div');
coverPreviewContainer.className = 'cover-preview-container';
coverPreviewContainer.innerHTML = `
    <div class="existing-file-info" id="existingCoverInfo" style="display: none; margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-radius: 4px;">
        <p><strong>Current Cover Image:</strong></p>
        <img class="cover-preview" id="existingCoverPreview" style="max-width: 200px; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; background: #fff;">
        <div style="margin-top: 10px;">
            <button type="button" class="btn-remove-file" id="removeCoverBtn" style="padding: 5px 15px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
                <i class="fas fa-trash"></i> Remove Cover Image
            </button>
        </div>
    </div>
    <div class="new-file-preview" id="newCoverPreview" style="display: none; margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-radius: 4px;">
        <p><strong>New Cover Image Preview:</strong></p>
        <img class="cover-preview" id="newCoverPreviewImg" style="max-width: 200px; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; background: #fff;">
    </div>
`;

// Create manuscript file preview container with existing file display
const manuscriptPreviewContainer = document.createElement('div');
manuscriptPreviewContainer.className = 'manuscript-preview-container';
manuscriptPreviewContainer.innerHTML = `
    <div class="existing-file-info" id="existingManuscriptInfo" style="display: none; margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-radius: 4px;">
        <p><strong>Current Manuscript File:</strong></p>
        <div style="display: flex; align-items: center; gap: 15px; margin-top: 10px;">
            <span id="existingManuscriptName" style="font-weight: 500; color: #0066cc;"></span>
            <div style="display: flex; gap: 10px;">
                <a href="#" id="viewManuscriptLink" target="_blank" class="btn-view-file" style="padding: 5px 15px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
                    <i class="fas fa-eye"></i> View
                </a>
                <button type="button" class="btn-remove-file" id="removeManuscriptBtn" style="padding: 5px 15px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
                    <i class="fas fa-trash"></i> Remove
                </button>
            </div>
        </div>
    </div>
    <div class="new-file-info" id="newManuscriptInfo" style="display: none; margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-radius: 4px;">
        <p><strong>New File Selected:</strong> <span id="newManuscriptName" style="color: #28a745;"></span></p>
    </div>
`;

// Add containers after inputs
if (manuscriptCoverInput) {
    manuscriptCoverInput.insertAdjacentElement('afterend', coverPreviewContainer);
    const note = document.createElement('small');
    note.className = 'text-muted';
    note.style.display = 'block';
    note.style.marginTop = '5px';
    note.innerHTML = '<i class="fas fa-info-circle"></i> Leave empty to keep existing cover image';
    manuscriptCoverInput.insertAdjacentElement('afterend', note);
}

if (manuscriptFileInput) {
    manuscriptFileInput.insertAdjacentElement('afterend', manuscriptPreviewContainer);
    const note = document.createElement('small');
    note.className = 'text-muted';
    note.style.display = 'block';
    note.style.marginTop = '5px';
    note.innerHTML = '<i class="fas fa-info-circle"></i> Leave empty to keep existing manuscript file';
    manuscriptFileInput.insertAdjacentElement('afterend', note);
}

// Track files to remove
let removeCover = false;
let removeManuscript = false;

// Handle cover image preview for new selection
if (manuscriptCoverInput) {
    manuscriptCoverInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const newPreview = document.getElementById('newCoverPreview');
        const newPreviewImg = document.getElementById('newCoverPreviewImg');
        const existingInfo = document.getElementById('existingCoverInfo');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                newPreviewImg.src = event.target.result;
                newPreview.style.display = 'block';
                if (existingInfo && existingInfo.style.display === 'block') {
                    existingInfo.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        } else {
            newPreview.style.display = 'none';
            if (!removeCover && existingInfo && existingInfo.getAttribute('data-has-file') === 'true') {
                existingInfo.style.display = 'block';
            }
        }
    });
}

// Handle manuscript file selection
if (manuscriptFileInput) {
    manuscriptFileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const newInfo = document.getElementById('newManuscriptInfo');
        const newName = document.getElementById('newManuscriptName');
        const existingInfo = document.getElementById('existingManuscriptInfo');
        
        if (file) {
            newName.textContent = file.name;
            newInfo.style.display = 'block';
            if (existingInfo && existingInfo.style.display === 'block') {
                existingInfo.style.display = 'none';
            }
        } else {
            newInfo.style.display = 'none';
            if (!removeManuscript && existingInfo && existingInfo.getAttribute('data-has-file') === 'true') {
                existingInfo.style.display = 'block';
            }
        }
    });
}

// Handle remove cover button
document.addEventListener('click', function(e) {
    if (e.target.id === 'removeCoverBtn' || e.target.closest('#removeCoverBtn')) {
        e.preventDefault();
        removeCover = true;
        
        const existingInfo = document.getElementById('existingCoverInfo');
        const newPreview = document.getElementById('newCoverPreview');
        
        existingInfo.style.display = 'none';
        if (manuscriptCoverInput) manuscriptCoverInput.value = '';
        if (newPreview) newPreview.style.display = 'none';
        
        let removeField = document.getElementById('remove_cover_field');
        if (!removeField) {
            removeField = document.createElement('input');
            removeField.type = 'hidden';
            removeField.name = 'remove_cover';
            removeField.id = 'remove_cover_field';
            removeField.value = 'true';
            if (manuscriptCoverInput) {
                manuscriptCoverInput.parentNode.appendChild(removeField);
            }
        }
        
        iziToast.info({
            message: "Cover image will be removed when you save",
            position: "topRight",
            timeout: 3000
        });
    }
});

// Handle remove manuscript button
document.addEventListener('click', function(e) {
    if (e.target.id === 'removeManuscriptBtn' || e.target.closest('#removeManuscriptBtn')) {
        e.preventDefault();
        removeManuscript = true;
        
        const existingInfo = document.getElementById('existingManuscriptInfo');
        const newInfo = document.getElementById('newManuscriptInfo');
        
        existingInfo.style.display = 'none';
        if (manuscriptFileInput) manuscriptFileInput.value = '';
        if (newInfo) newInfo.style.display = 'none';
        
        let removeField = document.getElementById('remove_manuscript_field');
        if (!removeField) {
            removeField = document.createElement('input');
            removeField.type = 'hidden';
            removeField.name = 'remove_manuscript';
            removeField.id = 'remove_manuscript_field';
            removeField.value = 'true';
            if (manuscriptFileInput) {
                manuscriptFileInput.parentNode.appendChild(removeField);
            }
        }
        
        iziToast.info({
            message: "Manuscript file will be removed when you save",
            position: "topRight",
            timeout: 3000
        });
    }
});

// Initialize Vue instance first
if (typeof Vue !== 'undefined') {
    window.app = new Vue({
        el: '#app',
        data: {
            keywords: [],
            saisie: "",
        },
        methods: {
            removeFromArray: function(index) {
                this.keywords.splice(index, 1);
                this.saisie = this.keywords.join(',');
                if (AuthorsArray) {
                    AuthorsArray.value = this.saisie;
                }
            },
        },
        watch: {
            saisie: function() {
                this.keywords = this.saisie.split(',').filter(x => x.trim() !== '');
                if (AuthorsArray) {
                    AuthorsArray.value = this.saisie;
                }
            }
        }
    });
    console.log("Vue instance initialized");
}

// Load article data
if (ArticleId && ArticleTitle) {
    console.log("Starting to load article data...");
    openModal();
    
    // First, get the article data
    fetch(`${EndPoint}/retrieveArticle.php?q=${ArticleId}&title=${ArticleTitle}`, {
        method: "GET"
    })
    .then(res => {
        console.log("Article fetch response status:", res.status);
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
    })
    .then(data => {
        console.log("Article data received:", data);
        
        if (data.articleData && data.articleData.length > 0) {
            const article = data.articleData[0];
            console.log("Article details:", {
                buffer: article.buffer,
                title: article.manuscript_full_title,
                email: article.corresponding_authors_email,
                manuscriptPhoto: article.manuscriptPhoto,
                manuscript_file: article.manuscript_file
            });
            
            // Set basic fields
            corresponsfinAuthor.value = article.corresponding_authors_email || "";
            title.value = article.manuscript_full_title || "";
            token.value = article.buffer || "";
            
            // Show existing cover image if available
            const existingCoverInfo = document.getElementById('existingCoverInfo');
            const existingCoverPreview = document.getElementById('existingCoverPreview');
            
            if (article.manuscriptPhoto && article.manuscriptPhoto !== "cover.jpg" && article.manuscriptPhoto !== "") {
                existingCoverPreview.src = `https://asfirj.org/useruploads/article_images/${article.manuscriptPhoto}`;
                existingCoverInfo.style.display = 'block';
                existingCoverInfo.setAttribute('data-has-file', 'true');
                console.log("Cover image loaded:", article.manuscriptPhoto);
            } else {
                existingCoverInfo.setAttribute('data-has-file', 'false');
                console.log("No cover image available");
            }

            // Show existing manuscript file if available
            const existingManuscriptInfo = document.getElementById('existingManuscriptInfo');
            const existingManuscriptName = document.getElementById('existingManuscriptName');
            const viewManuscriptLink = document.getElementById('viewManuscriptLink');
            
            if (article.manuscript_file && article.manuscript_file !== "") {
                existingManuscriptName.textContent = article.manuscript_file;
                viewManuscriptLink.href = `https://asfirj.org/useruploads/manuscripts/${article.manuscript_file}`;
                existingManuscriptInfo.style.display = 'block';
                existingManuscriptInfo.setAttribute('data-has-file', 'true');
                console.log("Manuscript file loaded:", article.manuscript_file);
            } else {
                existingManuscriptInfo.setAttribute('data-has-file', 'false');
                console.log("No manuscript file available");
            }

            console.log("Fetching authors for article ID:", article.buffer);
            // Get authors data after article data is loaded
            return fetch(`${EndPoint}/allAuthors.php?articleID=${article.buffer}`, {
                method: "GET"
            });
        } else {
            throw new Error(data.message || "Article not found");
        }
    })
    .then(res => {
        console.log("Authors fetch response status:", res.status);
        if (!res.ok) throw new Error('Failed to fetch authors');
        return res.json();
    })
    .then(authorData => {
        console.log("Raw authors data received:", authorData);
        
        if (authorData && authorData.authorsList) {
            console.log("Authors list:", authorData.authorsList);
            console.log("Number of authors:", authorData.authorsList.length);
            
            if (authorData.authorsList.length > 0) {
                // Log each author individually
                authorData.authorsList.forEach((author, index) => {
                    console.log(`Author ${index + 1}:`, author);
                });
                
                // Properly format authors names
                const authorsName = authorData.authorsList
                    .map(author => author.authors_fullname)
                    .join(',');
                
                console.log("Formatted authors names (comma-separated):", authorsName);
                
                // Set the authors array value
                AuthorsArray.value = authorsName;
                console.log("AuthorsArray input value set to:", AuthorsArray.value);
                
                // Update Vue instance if it exists
                if (window.app) {
                    window.app.saisie = authorsName;
                    console.log("Vue instance saisie updated to:", window.app.saisie);
                    console.log("Vue keywords array:", window.app.keywords);
                }
            } else {
                console.log("No authors found for this article");
                AuthorsArray.value = "";
                if (window.app) {
                    window.app.saisie = "";
                }
            }
        } else {
            console.log("Invalid authors data structure:", authorData);
            AuthorsArray.value = "";
            if (window.app) {
                window.app.saisie = "";
            }
        }
        
        console.log("Fetching article data again for Quill content...");
        // Now that authors are loaded, we need to fetch the article data again 
        // to get the Quill content (or we could have stored it from the first response)
        return fetch(`${EndPoint}/retrieveArticle.php?q=${ArticleId}&title=${ArticleTitle}`, {
            method: "GET"
        });
    })
    .then(res => {
        console.log("Second article fetch response status:", res.status);
        return res.json();
    })
    .then(data => {
        console.log("Second article data received for Quill:", data);
        
        if (data.articleData && data.articleData.length > 0) {
            const article = data.articleData[0];
            console.log("Quill content data:", {
                unstructured_abstract: article.unstructured_abstract,
                abstract_discussion: article.abstract_discussion
            });
            
            // Set Quill content
            try {
                const quillContent = article.unstructured_abstract ? 
                    JSON.parse(article.unstructured_abstract) : 
                    { ops: [{ insert: "\n" }] };
                const quillContent2 = article.abstract_discussion ? 
                    JSON.parse(article.abstract_discussion) : 
                    { ops: [{ insert: "\n" }] };

                console.log("Parsed Quill content:", quillContent);
                console.log("Parsed Quill content 2:", quillContent2);

                // Wait for Quill to be ready
                const quillCheckInterval = setInterval(() => {
                    if (quill && quill2) {
                        console.log("Quill editors are ready, setting content...");
                        clearInterval(quillCheckInterval);
                        quill.setContents(quillContent);
                        quill2.setContents(quillContent2);
                        console.log("Quill content set successfully");
                    }
                }, 100);
            } catch (e) {
                console.error("Error parsing Quill content:", e);
                if (quill) quill.setContents({ ops: [{ insert: "\n" }] });
                if (quill2) quill2.setContents({ ops: [{ insert: "\n" }] });
            }
        }
    })
    .catch(error => {
        console.error("Error loading article data:", error);
        console.error("Error stack:", error.stack);
        iziToast.error({
            message: error.message || "Error loading article data",
            position: "topRight"
        });
    });
} else {
    console.log("Article ID or Title missing from URL parameters");
}

// Form submission
const EditArticleForm = document.getElementById('editArticle');
if (EditArticleForm) {
    EditArticleForm.addEventListener("submit", function(e) {
        e.preventDefault();
        console.log("Form submission started");
        
        const formData = new FormData(EditArticleForm);
        
        // Log form data before submission
        console.log("Authors array value before submission:", AuthorsArray.value);
        console.log("Corresponding author email before submission:", corresponsfinAuthor.value);
        console.log("Title before submission:", title.value);
        
        // Add Quill content
        try {
            if (quill && quill.getContents) {
                const quillContent = quill.getContents();
                console.log("Quill content being submitted:", quillContent);
                formData.append('article_content', JSON.stringify(quillContent));
            }
            if (quill2 && quill2.getContents) {
                const quillContent2 = quill2.getContents();
                console.log("Quill content 2 being submitted:", quillContent2);
                formData.append('abstract_discussion', JSON.stringify(quillContent2));
            }
        } catch (e) {
            console.error("Error getting Quill content:", e);
            iziToast.error({
                message: "Error preparing article content",
                position: "topRight"
            });
            return;
        }

        // Add files only if selected
        if (manuscriptFileInput && manuscriptFileInput.files.length > 0) {
            console.log("New manuscript file selected:", manuscriptFileInput.files[0].name);
            formData.append('manuscript_file', manuscriptFileInput.files[0]);
        }
        
        if (manuscriptCoverInput && manuscriptCoverInput.files.length > 0) {
            console.log("New cover image selected:", manuscriptCoverInput.files[0].name);
            formData.append('manuscriptCover', manuscriptCoverInput.files[0]);
        }

        const body = document.querySelector("body");
        body.removeAttribute("id");

        console.log("Sending form data to server...");
        fetch(`${EndPoint}/editManuscript.php`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log("Submission response status:", response.status);
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
        })
        .then(data => {
            console.log("Submission response data:", data);
            
            if (data.status === "success") {
                console.log("Article edited successfully");
                iziToast.success({
                    message: "Article Edited Successfully",
                    position: "topRight",
                    onClosed: function() {
                        console.log("Redirecting to manage page...");
                        window.location.href = "../manage";
                    }
                });
            } else {
                console.error("Submission error:", data.message);
                iziToast.error({
                    message: data.message || "Error updating article",
                    position: "topRight"
                });
                body.setAttribute("id", "formNotSubmitted");
            }
        })
        .catch(error => {
            console.error('Submission fetch error:', error);
            console.error('Error stack:', error.stack);
            iziToast.error({
                message: "Network error occurred. Please try again.",
                position: "topRight"
            });
        });
    });
}

// Add styles for preview containers
const style = document.createElement('style');
style.textContent = `
    .cover-preview-container, .manuscript-preview-container {
        margin-top: 15px;
    }
    .cover-preview {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        background: #f8f9fa;
    }
    .btn-remove-file, .btn-view-file {
        transition: all 0.3s ease;
        display: inline-block;
    }
    .btn-remove-file:hover {
        background-color: #c82333 !important;
        transform: translateY(-1px);
    }
    .btn-view-file:hover {
        background-color: #0056b3 !important;
        transform: translateY(-1px);
        text-decoration: none;
        color: white;
    }
    .existing-file-info, .new-file-preview, .new-file-info {
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .text-muted {
        color: #6c757d;
        font-size: 0.875rem;
    }
    .text-muted i {
        margin-right: 5px;
    }
`;
document.head.appendChild(style);

console.log("Script loaded and initialized");