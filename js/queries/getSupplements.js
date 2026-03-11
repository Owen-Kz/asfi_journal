import { EndPoint } from "../constants.js"
import { formatTimestamp } from "../formatDate.js";
import { DownloadItem } from "./downloadCount.js";

const manu_title = document.getElementById("manu_title");
const published_date = document.getElementById("published_date")
const authorsContainerTop = document.getElementById("authorsContainerTop")
const authorsListBottom = document.getElementById("authorsListBottom")
const downloadLinks = document.querySelectorAll(".downloadLink")
const viewCountContainer = document.getElementById("viewCountContainer")
const downloadsCountContainer = document.getElementById("downloadsCountContainer")
const issueNumber = document.getElementById("issueNumber")
const pageNumber = document.getElementById("pageNumber")
const doiNumber = document.getElementById("doiNumber")
const dateSubmitted = document.getElementById("dateSubmitted")
const dateReviewed = document.getElementById("dateReviewed")
const dateAccepted = document.getElementById("dateAccepted")
const datePublished = document.getElementById("datePublished")

// Helper function to detect if content is Quill Delta format
function isQuillDelta(content) {
    if (!content) return false;
    
    // If it's a string, check if it starts with { or [ and contains "ops" or "insert"
    if (typeof content === 'string') {
        const trimmed = content.trim();
        // Check for Quill object format: {"ops": [...]}
        if (trimmed.startsWith('{') && trimmed.includes('"ops"')) {
            return true;
        }
        // Check for Quill array format: [{"insert": "text"}]
        if (trimmed.startsWith('[') && trimmed.includes('"insert"')) {
            return true;
        }
        return false;
    }
    
    // If it's already an object
    if (typeof content === 'object' && content !== null) {
        // Format 1: Object with ops property {ops: [...]}
        if (content.ops && Array.isArray(content.ops) && content.ops.length > 0) {
            return true;
        }
        
        // Format 2: Direct array [{...}, {...}]
        if (Array.isArray(content) && content.length > 0 && content[0].insert !== undefined) {
            return true;
        }
    }
    
    return false;
}

// Helper function to detect if content is regular HTML
function isRegularHTML(content) {
    if (!content) return false;
    
    if (typeof content === 'string') {
        // Check for HTML tags
        const trimmed = content.trim();
        return trimmed.startsWith('<') && (trimmed.includes('</') || trimmed.includes('/>'));
    }
    
    return false;
}

// Helper function to check if Quill content is valid (handles both formats)
function hasQuillContent(quillData) {
    if (!quillData) return false;
    
    return isQuillDelta(quillData);
}

// Helper function to get Quill content in standard format
function getQuillContent(quillData) {
    if (!quillData) return { ops: [] };
    
    // If it's a string, try to parse it
    if (typeof quillData === 'string') {
        try {
            const parsed = JSON.parse(quillData);
            return getQuillContent(parsed);
        } catch (e) {
            // Not JSON, treat as plain text
            return { ops: [{ insert: quillData }] };
        }
    }
    
    // If it's already in {ops: [...]} format
    if (quillData.ops && Array.isArray(quillData.ops)) {
        return quillData;
    }
    
    // If it's a direct array, convert to {ops: [...]} format
    if (Array.isArray(quillData)) {
        return { ops: quillData };
    }
    
    // If format is unknown, return empty
    console.warn("Unknown Quill format:", quillData);
    return { ops: [] };
}

// Helper function to safely parse JSON
function safeParseJSON(jsonString) {
    if (!jsonString) return null;
    try {
        return JSON.parse(jsonString);
    } catch (error) {
        console.error("Error parsing JSON:", error, "String:", jsonString);
        return jsonString; // Return the original string if parsing fails
    }
}

// Function to render content (handles both Quill and HTML)
function renderContent(divId, content) {
    if (!divId) return Promise.resolve();
    
    const toDisplay = document.getElementById(divId);
    if (!toDisplay) {
        console.error(`Element with id "${divId}" not found`);
        return Promise.reject(new Error(`Element with id "${divId}" not found`));
    }

    // Show loader
    toDisplay.innerHTML = `
        <div class="loader-container" style="text-align: center; padding: 20px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading content...</p>
        </div>
    `;

    return new Promise((resolve) => {
        // Small delay to allow loader to render
        setTimeout(() => {
            try {
                if (!content) {
                    toDisplay.innerHTML = '<p class="text-muted">No content available</p>';
                    resolve();
                    return;
                }

                // Try to parse if it's a string
                let parsedContent = content;
                if (typeof content === 'string') {
                    // Check if it's regular HTML
                    if (isRegularHTML(content)) {
                        toDisplay.innerHTML = content;
                        resolve();
                        return;
                    }
                    
                    // Try to parse as JSON for Quill content
                    try {
                        parsedContent = JSON.parse(content);
                    } catch (e) {
                        // Not JSON, treat as plain text
                        toDisplay.innerHTML = `<p>${content}</p>`;
                        resolve();
                        return;
                    }
                }

                // Check if it's Quill Delta format
                if (isQuillDelta(parsedContent)) {
                    renderQuillContent(divId, parsedContent).then(resolve);
                } 
                // Check if it's regular HTML (as object)
                else if (typeof parsedContent === 'string' && isRegularHTML(parsedContent)) {
                    toDisplay.innerHTML = parsedContent;
                    resolve();
                }
                // If it's plain text
                else if (typeof parsedContent === 'string') {
                    toDisplay.innerHTML = `<p>${parsedContent}</p>`;
                    resolve();
                }
                // If it's an unknown format, stringify it
                else {
                    toDisplay.innerHTML = `<p>${String(parsedContent)}</p>`;
                    resolve();
                }
            } catch (error) {
                console.error(`Error rendering content for ${divId}:`, error);
                toDisplay.innerHTML = '<p class="text-danger">Content could not be loaded</p>';
                resolve();
            }
        }, 50);
    });
}

// Function to render Quill content with chunking for large content
function renderQuillContent(divId, deltaContent, chunkSize = 10, delay = 30) {
    const toDisplay = document.getElementById(divId);
    if (!toDisplay) {
        return Promise.reject(new Error(`Element with id "${divId}" not found`));
    }

    // Get content in standard format
    const standardContent = getQuillContent(deltaContent);
    
    // Check if content is actually valid
    if (!standardContent.ops || standardContent.ops.length === 0) {
        toDisplay.innerHTML = '<p class="text-muted">No content available</p>';
        return Promise.resolve();
    }

    return new Promise((resolve) => {
        // Create a Quill instance in a temporary div
        const tempDiv = document.createElement('div');
        
        // Check if Quill is available
        if (typeof Quill === 'undefined') {
            console.error('Quill library not loaded');
            // Fallback: try to extract text from ops
            const text = standardContent.ops.map(op => op.insert || '').join('');
            toDisplay.innerHTML = `<p>${text}</p>`;
            resolve();
            return;
        }

        const quill = new Quill(tempDiv, {
            theme: 'snow',
            modules: { toolbar: false },
            readOnly: true,
        });

        // For small content (less than 50 ops), render immediately
        if (standardContent.ops.length < 50) {
            try {
                quill.setContents(standardContent);
                toDisplay.innerHTML = tempDiv.innerHTML;
                resolve();
            } catch (error) {
                console.error('Error rendering Quill content:', error);
                // Fallback to plain text
                const text = standardContent.ops.map(op => op.insert || '').join('');
                toDisplay.innerHTML = `<p>${text}</p>`;
                resolve();
            }
            return;
        }

        // For large content, render in chunks
        const ops = standardContent.ops;
        const chunks = [];
        for (let i = 0; i < ops.length; i += chunkSize) {
            chunks.push(ops.slice(i, i + chunkSize));
        }

        // Clear the container and show loader
        toDisplay.innerHTML = '<div class="loader-container"><div class="spinner-border text-primary"></div><p>Loading content...</p></div>';
        
        // Function to render next chunk
        function renderNextChunk(index) {
            if (index >= chunks.length) {
                // All chunks rendered
                resolve();
                return;
            }

            setTimeout(() => {
                try {
                    // Set content for current chunk
                    quill.setContents({ ops: chunks[index] }, 'api');
                    
                    // Update the display
                    if (index === 0) {
                        // First chunk, replace loader
                        toDisplay.innerHTML = tempDiv.innerHTML;
                    } else {
                        // For subsequent chunks, we need to append
                        const tempDiv2 = document.createElement('div');
                        const quill2 = new Quill(tempDiv2, {
                            theme: 'snow',
                            modules: { toolbar: false },
                            readOnly: true,
                        });
                        quill2.setContents({ ops: chunks[index] }, 'api');
                        toDisplay.innerHTML += tempDiv2.innerHTML;
                    }
                } catch (error) {
                    console.error(`Error rendering chunk ${index}:`, error);
                    // Continue with next chunk even if this one fails
                }

                // Render next chunk
                renderNextChunk(index + 1);
            }, delay);
        }

        // Start rendering chunks
        renderNextChunk(0);
    });
}

function getSupplement(articeID) {
    // Show loader for abstract immediately
    const abstractContainer = document.getElementById('abstract');
    if (abstractContainer) {
        abstractContainer.innerHTML = `
            <div class="abstract-loader" style="text-align: center; padding: 40px;">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading abstract...</span>
                </div>
                <p class="mt-3">Loading abstract content...</p>
            </div>
        `;
    }

    // Show loader for content
    const contentContainer = document.getElementById('content');
    if (contentContainer) {
        contentContainer.innerHTML = `
            <div class="content-loader" style="text-align: center; padding: 40px;">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading content...</span>
                </div>
                <p class="mt-3">Loading manuscript content...</p>
            </div>
        `;
    }

    // Function to set up download links first (highest priority)
    function setupDownloadLinks(ManuscriptFile, ArticleTitle, buffer) {
        downloadLinks.forEach(link => {
            link.setAttribute("href", `../useruploads/manuscripts/${ManuscriptFile}`);
            link.setAttribute("download", `${ArticleTitle}.pdf`);
            link.addEventListener("click", function() {
                DownloadItem(buffer);
            });
            // Make sure links are visible and functional
            link.style.pointerEvents = 'auto';
            link.style.opacity = '1';
        });
    }

    // Function to load basic article info (medium priority)
    function loadBasicInfo(Article) {
        const ArticleTitle = Article[0].manuscript_full_title;
        const ManuscriptFile = Article[0].manuscript_file;
        const buffer = Article[0].buffer;
        
        manu_title.innerText = ArticleTitle;
        
        // Format dates
        let DateUploaded = "N/A";
        if(Article[0].date_uploaded != null && Article[0].date_uploaded != "" && Article[0].date_uploaded){
            DateUploaded = formatTimestamp(Article[0].date_uploaded);
        }
        published_date.innerText = `${DateUploaded}`;

        return { ArticleTitle, ManuscriptFile, buffer };
    }

    // Function to load statistics and metadata (low priority)
    function loadMetadata(Article) {
        const viewsCount = Article[0].views_count;
        const correspondingAuthorsEmail = Article[0].corresponding_authors_email;
        const hyperLink = Article[0].hyperlink_to_others;
        const DownloadsCount = Article[0].downloads_count;
        const Issue = Article[0].issues_number;
        const Page = Article[0].page_number;
        const Doi = Article[0].doi_number;
        
        let SubmittedDate = "N/A";
        let ReviewedDate = "N/A";
        let AcceptedDate = "N/A";
        let PublishedDate = "N/A";

        if(Article[0].date_submitted != null && Article[0].date_submitted != "" && Article[0].date_submitted){
            SubmittedDate = formatTimestamp(Article[0].date_submitted);
        }

        if(Article[0].date_reviewed != null && Article[0].date_reviewed != "" && Article[0].date_reviewed){
            ReviewedDate = formatTimestamp(Article[0].date_reviewed);
        }

        if(Article[0].date_accepted != null && Article[0].date_accepted != "" && Article[0].date_accepted){
            AcceptedDate = formatTimestamp(Article[0].date_accepted);
        }

        if(Article[0].date_published != null && Article[0].date_published != "" && Article[0].date_published){
            PublishedDate = formatTimestamp(Article[0].date_published);
        }

        // Update metadata containers
        viewCountContainer.innerText = `${viewsCount} Views`;
        downloadsCountContainer.innerText = `${DownloadsCount} Downloads`;
        issueNumber.innerText = `Issue Number: ${Issue}`;
        pageNumber.innerText = `Page Number: ${Page}`;
        doiNumber.innerText = `DOI Number: ${Doi}`;
        dateSubmitted.innerText = `Date Submitted: ${SubmittedDate}`;
        dateReviewed.innerText = `Date Revised: ${ReviewedDate}`;
        dateAccepted.innerText = `Date Accepted: ${AcceptedDate}`;
        datePublished.innerText = `Date Published: ${PublishedDate}`;

        const correspondingAuthorsEmailContainer = document.getElementById("correspondingAuthorsEmail");
        correspondingAuthorsEmailContainer.innerHTML += ` <a style="color:#333;" href="mailto:${correspondingAuthorsEmail}">${correspondingAuthorsEmail}</a>`;
        
        const hyperlinkContainer = document.getElementById("hyperlink");
        if(hyperLink != null && hyperLink !== "null" && hyperLink !== ""){
            hyperlinkContainer.innerHTML += `<a style="color:#333;" href="${hyperLink}">${hyperLink}</a>`;
        }else{
            hyperlinkContainer.style.display = "none";
        }
    }

    // Function to load authors (medium priority)
    function loadAuthors(buffer) {
        return fetch(`${EndPoint}/allAuthors.php?articleID=${buffer}`, {
            method: "GET"
        }).then(res => res.json())
            .then(data => {
                if (data && data.authorsList) {
                    const AllAuthors = data.authorsList;
                    let AuthorsName = "";

                    // Clear existing authors
                    authorsListBottom.innerHTML = '';
                    
                    // Add authors to bottom list
                    AllAuthors.forEach(author => {
                        const AuthorsFullname = `${author.authors_fullname}`;
                        authorsListBottom.innerHTML += `<li> ${AuthorsFullname} </li>`;
                    });
                    
                    // Build authors string for top container
                    for(let i = 0; i < AllAuthors.length; i++){
                        if(i < AllAuthors.length - 1){
                            AuthorsName += `${AllAuthors[i].authors_fullname}, `;
                        }else{
                            AuthorsName += `${AllAuthors[i].authors_fullname}.`;
                        }
                    }

                    authorsContainerTop.innerText = AuthorsName;
                    return true;
                } else {
                    console.log("No authors data found");
                    return false;
                }
            })
            .catch(error => {
                console.error("Error fetching authors:", error);
                return false;
            });
    }

    // Function to load content (handles both Quill and HTML)
    function loadContent(unstructuredAbstract, AbstractDiscussoin) {
        return new Promise((resolve) => {
            // Parse the content
            const content1 = safeParseJSON(unstructuredAbstract);
            const content2 = safeParseJSON(AbstractDiscussoin);

            // Load main content first
            renderContent('content', content1).then(() => {
                // Load abstract content
                if (content2) {
                    const abstractHeader = document.getElementById("abstractHeader");
                    abstractHeader.style.display = "block";
                    renderContent('abstract', content2).then(resolve);
                } else {
                    const abstractContainer = document.getElementById('abstract');
                    if (abstractContainer) {
                        abstractContainer.innerHTML = '<p class="text-muted">No abstract available</p>';
                    }
                    resolve();
                }
            });
        });
    }

    // Main fetch function with prioritized loading
    fetch(`${EndPoint}/retrieveArticle.php?q=${articeID}`, {
        method: "GET"
    }).then(res => res.json())
        .then(data => {
            if (data.articleData && data.articleData.length > 0) {
                const Article = data.articleData;
                
                // PHASE 1: Load download links immediately (highest priority)
                const basicInfo = loadBasicInfo(Article);
                setupDownloadLinks(basicInfo.ManuscriptFile, basicInfo.ArticleTitle, basicInfo.buffer);
                
                // Set cover photo (quick operation)
                const coverPhoto = Article[0].manuscriptPhoto;
                const previewHead = document.getElementById("previewHead");
                const mainCoverImage = `../images/articleImages/8.jpg`;
                previewHead.setAttribute("style", `background-image: url(${mainCoverImage}); background-size: cover; background-repeat: no-repeat;`);
                
                // PHASE 2: Load authors and metadata (medium priority)
                // Load authors
                loadAuthors(basicInfo.buffer);
                
                // Load metadata with a small delay to prioritize user interaction
                setTimeout(() => {
                    loadMetadata(Article);
                }, 100);
                
                // PHASE 3: Load content (handles both Quill and HTML)
                setTimeout(() => {
                    const unstructuredAbstract = Article[0].unstructured_abstract;
                    const AbstractDiscussoin = Article[0].abstract_discussion;
                    
                    loadContent(unstructuredAbstract, AbstractDiscussoin);
                }, 300);
                
            } else {
                alert("File Not found on server");
            }
        })
        .catch(error => {
            console.error("Error fetching article data:", error);
            alert("An error occurred while loading the article");
        });
}

export {
    getSupplement
}