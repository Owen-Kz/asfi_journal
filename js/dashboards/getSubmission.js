import { GetParameters, submissionsEndpoint } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { GetKeywords } from "../forms/getKeywords.js";

// DOM Elements
const manu_title = document.getElementById("manu_title");
const published_date = document.getElementById("published_date");
const authorsListBottom = document.getElementById("authorsListBottom");
const filesContainer = document.getElementById("filesContainer");
const ArticleTypeContainer = document.getElementById("articleTypeContainer");
const DiscisplineContainer = document.getElementById("disciplineContainer");
const statusContainer = document.getElementById("status");
const correspondingAuthorsEmailContainer = document.getElementById("correspondingAuthorsEmail");
const keywordsContainer = document.getElementById("keywordsContainer");
const contentDiv = document.getElementById("content");
const sidebarStatus = document.getElementById("sidebarStatus");
const sidebarArticleType = document.getElementById("sidebarArticleType");
const mobileStatus = document.getElementById("mobileStatus");
const mobileArticleType = document.getElementById("mobileArticleType");
const previousManuscriptId = document.getElementById("previous_manuscript_id");

const ArticleIdQuery = GetParameters(window.location.href).get("a");
const ActionsContainer = document.getElementById("action_container");

if(ArticleIdQuery){
    getSupplement(ArticleIdQuery);
} else {
    window.location.href = "../../dashboard/authordash/manuscripts";
}

async function getSupplement(articeID) {
    try {
        const response = await fetch(`https://greek.asfirj.org/backend/accounts/getArticleInfo.php`, {
            method: "POST",
            body: JSON.stringify({id: articeID}),
            headers: {
                "Content-type": "application/JSON"
            }
        });
        
        const data = await response.json();
        
        if (data.articles) {
            const Article = data.articles;

            if (Article) {
                // Update sidebar and mobile info
                updateSidebarInfo(Article);
                
                const ArticleTitle = Article.title;
                const ArticleType = Article.article_type;
                const coverLetter = Article.cover_letter_file;
                const discipline = Article.discipline;
                const ManuscriptFile = Article.manuscript_file;
                const Status = Article.status;
                const ManuscriptDocument = Article.document_file;
                const unstructuredAbstract = Article.abstract;
                const correspondingAuthorsEmail = Article.corresponding_authors_email;
                const DateUploaded = formatTimestamp(Article.date_submitted);
                
                // Set basic information
                manu_title.innerText = ArticleTitle;
                published_date.innerText = DateUploaded;
                ArticleTypeContainer.innerText = ArticleType;
                DiscisplineContainer.innerText = discipline;
                
                // Set corresponding author email
                correspondingAuthorsEmailContainer.innerHTML = `
                    <span class="text-gray-600">Email:</span> 
                    <a href="mailto:${correspondingAuthorsEmail}" class="text-primary hover:underline">${correspondingAuthorsEmail}</a>
                `;
                
                // Set status with appropriate styling
                setStatus(Status);
                
                // Set previous manuscript ID if available
                if (Article.previous_manuscript_id) {
                    previousManuscriptId.textContent = Article.previous_manuscript_id;
                } else {
                    previousManuscriptId.textContent = "None";
                }
                
                // Handle files display
                await handleFilesDisplay(Article, coverLetter, ManuscriptFile);
                
                // Get and display authors
                await getAuthors(Article.article_id);
                
                // Render Quill content
                renderQuillContent(unstructuredAbstract);
                
                // Get and display keywords
                await displayKeywords(articeID);
                
                // Handle actions based on status
                handleActions(Status, articeID);
                
            } else {
                showError("File not found on server");
            }
        }else{
            showError("Error loading manuscript. This Manuscript does not exist or has been Archived.");
            window.location.href = "../"
        }
    } catch (error) {
        console.error("Error fetching article info:", error);
        showError("Error loading manuscript. Please try again.");
    }
}

function updateSidebarInfo(Article) {
    const statusText = getStatusText(Article.status);
    sidebarStatus.textContent = statusText;
    mobileStatus.textContent = statusText;
    sidebarArticleType.textContent = Article.article_type;
    mobileArticleType.textContent = Article.article_type;
}

function setStatus(status) {
    let statusText = "";
    let statusColor = "bg-gray-100 text-gray-800";
    
    switch(status) {
        case "returned_for_revision":
            statusText = "Returned For Revision";
            statusColor = "bg-yellow-100 text-yellow-800";
            break;
        case "returned_for_correction":
            statusText = "Returned For Correction";
            statusColor = "bg-yellow-100 text-yellow-800";
            break;
        case "submitted_for_review":
        case "review_submitted":
        case "revision_submitted":
            statusText = "Under Review";
            statusColor = "bg-blue-100 text-blue-800";
            break;
        case "saved_for_later":
        case "revision_saved":
            statusText = "Manuscript Saved as Draft";
            statusColor = "bg-gray-100 text-gray-800";
            break;
        case "submitted":
            statusText = "Submitted";
            statusColor = "bg-purple-100 text-purple-800";
            break;
        case "correction_saved":
            statusText = "Manuscript Saved as Draft";
            statusColor = "bg-gray-100 text-gray-800";
            break;
        case "accepted":
            statusText = "Approved By Editor";
            statusColor = "bg-green-100 text-green-800";
            break;
        default:
            statusText = status;
            statusColor = "bg-gray-100 text-gray-800";
    }
    
    statusContainer.textContent = statusText;
    statusContainer.className = `status-badge ${statusColor}`;
}

function getStatusText(status) {
    const statusMap = {
        "returned_for_revision": "Revision Requested",
        "returned_for_correction": "Correction Needed",
        "submitted_for_review": "Under Review",
        "review_submitted": "Under Review",
        "revision_submitted": "Under Review",
        "saved_for_later": "Draft",
        "revision_saved": "Draft",
        "submitted": "Submitted",
        "correction_saved": "Draft",
        "accepted": "Approved"
    };
    
    return statusMap[status] || status;
}

async function handleFilesDisplay(Article, coverLetter, ManuscriptFile) {
    let coverLetterMan = "";
    let MANUSCRIPT_FILE = "";
    let DOCUMENTFILE = "";
    
    if (Article.date_submitted < "2025-01-07") {
        MANUSCRIPT_FILE = `https://greek.asfirj.org/uploadedFiles/${ManuscriptFile}`;
        
        if (Article.document_file !== "dummy.pdf") {
            DOCUMENTFILE = `<div class="mt-2">
                <a href="https://greek.asfirj.org/uploadedFiles/${Article.document_file}" 
                   class="inline-flex items-center text-primary hover:underline" target="_blank">
                    <i class="bi bi-file-earmark-text mr-2"></i>View Manuscript Document File
                </a>
            </div>`;
        }
    } else {
        // Handle cloudinary files
        if (Article.manuscript_file && Article.manuscript_file !== null) {
            if (Article.manuscript_file.slice(0, 26) === 'https://res.cloudinary.com') {
                MANUSCRIPT_FILE = `https://process.asfirj.org/doc?url=${Article.manuscript_file}`;
            } else {
                MANUSCRIPT_FILE = `https://greek.asfirj.org/uploadedFiles/${Article.manuscript_file}`;
            }
        } else {
            MANUSCRIPT_FILE = "#";
        }
        
        const filesArrayCont = [];
        const supplements = Article.supplementary_material;
        if (supplements) filesArrayCont.push(supplements);
        
        const graphicAbstract = Article.graphic_abstract;
        if (graphicAbstract) filesArrayCont.push(graphicAbstract);
        
        const figures = Article.figures;
        if (figures) filesArrayCont.push(figures);
        
        const tables = Article.tables;
        if (tables) filesArrayCont.push(tables);
        
        const trackedManuscriptFile = Article.tracked_manuscript_file;
        if (trackedManuscriptFile) filesArrayCont.push(trackedManuscriptFile);
        
        if (filesArrayCont.length > 0) {
            DOCUMENTFILE = `<div class="mt-3">
                <p class="font-medium text-gray-800 mb-2">Additional Document Files:</p>
                <div class="space-y-1">`;
            
            filesArrayCont.forEach(file => {
                if (file.slice(0, 26) === 'https://res.cloudinary.com') {
                    DOCUMENTFILE += `
                        <a href="https://process.asfirj.org/doc?url=${file}" 
                           class="inline-flex items-center text-primary hover:underline block" target="_blank">
                            <i class="bi bi-file-earmark-text mr-2"></i>${file.substring(file.lastIndexOf("/") + 1)}
                        </a>
                    `;
                } else {
                    DOCUMENTFILE += `
                        <a href="${file}" 
                           class="inline-flex items-center text-primary hover:underline block" target="_blank">
                            <i class="bi bi-file-earmark-text mr-2"></i>${file.substring(file.lastIndexOf("/") + 1)}
                        </a>
                    `;
                }
            });
            
            DOCUMENTFILE += `</div></div>`;
        }
    }
    
    // Handle cover letter
    if (coverLetter.slice(0, 26) === 'https://res.cloudinary.com') {
        coverLetterMan = `
            <a href="https://process.asfirj.org/doc?url=${coverLetter}" 
               class="inline-flex items-center text-primary hover:underline" target="_blank">
                <i class="bi bi-file-earmark-text mr-2"></i>View Cover Letter
            </a>
        `;
    } else {
        coverLetterMan = `
            <a href="https://greek.asfirj.org/uploadedFiles/${coverLetter}" 
               class="inline-flex items-center text-primary hover:underline" target="_blank">
                <i class="bi bi-file-earmark-text mr-2"></i>View Cover Letter
            </a>
        `;
    }
    
    // Update files container
    filesContainer.innerHTML = `
        <div class="space-y-3">
            <div>${coverLetterMan}</div>
            <div>
                <p class="font-medium text-gray-800">Manuscript File</p>
                <p class="text-sm text-gray-600 mb-1">A combination of all files submitted in PDF format (tables, figures, supplementary materials)</p>
                <a href="${MANUSCRIPT_FILE}" class="inline-flex items-center text-primary hover:underline" target="_blank">
                    <i class="bi bi-file-earmark-pdf mr-2"></i>View Manuscript File
                </a>
            </div>
            ${DOCUMENTFILE}
        </div>
    `;
}

async function getAuthors(articleID) {
    try {
        const response = await fetch(`https://greek.asfirj.org/backend/accounts/articleAuthors.php?articleID=${articleID}`);
        const data = await response.json();
        
        if (data && data.authorsList) {
            const AllAuthors = data.authorsList;
            authorsListBottom.innerHTML = '';
            
            AllAuthors.forEach(author => {
                const authorElement = document.createElement('li');
                authorElement.className = 'bg-white p-3 rounded-lg border border-gray-200';
                authorElement.innerHTML = `
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium mr-3">
                            ${author.authors_fullname.charAt(0)}
                        </div>
                        <span class="text-gray-800">${author.authors_fullname}</span>
                    </div>
                `;
                authorsListBottom.appendChild(authorElement);
            });
        }
    } catch (error) {
        console.error("Error fetching authors:", error);
        authorsListBottom.innerHTML = '<li class="text-gray-500">Error loading authors</li>';
    }
}

function renderQuillContent(unstructuredAbstract) {
    try {
        const quillContent = JSON.parse(unstructuredAbstract);
        
        // Create a Quill instance in a temporary div
        const tempDiv = document.createElement('div');
        const quill = new Quill(tempDiv, {
            theme: 'snow',
            modules: { toolbar: false },
            readOnly: true,
        });

        // Set the content as Quill Delta and extract the HTML
        quill.setContents(quillContent);

        // Get the innerHTML from the Quill editor
        const htmlContent = tempDiv.innerHTML;

        // Render the extracted HTML into the content div
        contentDiv.innerHTML = htmlContent;
        
        // Add Tailwind prose classes for better typography
        contentDiv.classList.add('prose', 'max-w-none');
        
    } catch (error) {
        console.error("Error rendering Quill content:", error);
        contentDiv.innerHTML = `
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-yellow-800">Error displaying abstract content. Showing raw text:</p>
                <div class="mt-2 p-3 bg-white rounded border">
                    ${unstructuredAbstract}
                </div>
            </div>
        `;
    }
}

async function displayKeywords(articleID) {
    try {
        const keywords = await GetKeywords(articleID);
        keywordsContainer.innerHTML = '';
        
        if (keywords && keywords.length > 0) {
            keywords.forEach(keyword => {
                const keywordElement = document.createElement('span');
                keywordElement.className = 'bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm';
                keywordElement.textContent = keyword.keyword;
                keywordsContainer.appendChild(keywordElement);
            });
        } else {
            keywordsContainer.innerHTML = '<span class="text-gray-500">No keywords specified</span>';
        }
    } catch (error) {
        console.error("Error fetching keywords:", error);
        keywordsContainer.innerHTML = '<span class="text-red-500">Error loading keywords</span>';
    }
}

function handleActions(Status, articeID) {
    if (Status === "review_submitted") {
        ActionsContainer.innerHTML = `
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="bi bi-lightning mr-2"></i> Actions
            </h3>
            <div class="flex flex-wrap gap-3">
                <a href="../reviews?a=${articeID}" 
                   class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-800 transition-colors">
                    <i class="bi bi-eye mr-2"></i> View Reviews
                </a>
            </div>
        `;
    } else {
        ActionsContainer.innerHTML = `
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="bi bi-lightning mr-2"></i> Actions
            </h3>
            <p class="text-gray-500 italic">There are no actions available at this time.</p>
        `;
    }
}

function showError(message) {
    // You could implement a more sophisticated error display here
    alert(message);
}

export {
    getSupplement
}