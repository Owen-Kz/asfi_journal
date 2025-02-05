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

                   
function getSupplement(articeID) {
    fetch(`${EndPoint}/retrieveArticle.php?q=${articeID}`, {
        method: "GET"
    }).then(res => res.json())
        .then(data => {
            if (data.articleData) {
                const Article = data.articleData

                if (Article.length > 0) {
                    const ArticleTitle = Article[0].manuscript_full_title
                    const ArticleRunningTitle = Article[0].manuscript_running_title
                    const Tables = Article[0].manuscript_tables
                    const Figures = Article[0].figures
                    const CoverLetter = Article[0].cover_letter
                    const ManuscriptFile = Article[0].manuscript_file
                    const SuppluimentaryMaterials = Article[0].supplimentary_materials
                    const GraphicAbstract = Article[0].graphic_abstract
                    const AbstractBackground = Article[0].abstract_background
                    const AbstractObjective = Article[0].absteact_objectives
                    const ABstractMethod = Article[0].abstract_method
                    const AbstractResult = Article[0].abstract_results
                    const AbstractDiscussoin = Article[0].abstract_discussion
                    const unstructuredAbstract = Article[0].unstructured_abstract
                    const status = Article[0].status
                    const viewsCount = Article[0].views_count
                    const correspondingAuthorsEmail = Article[0].corresponding_authors_email
                    const hyperLink = Article[0].hyperlink_to_others
                    const DownloadsCount = Article[0].downloads_count
                    const Issue = Article[0].issues_number
                    const Page = Article[0].page_number
                    const Doi = Article[0].doi_number
                    const coverPhoto = Article[0].manuscriptPhoto 
                    console.log(coverPhoto)
                    let mainCoverImage = ""


                    const previewHead = document.getElementById("previewHead")
                    // if(coverPhoto !== "cover.jpg"){
                    //     mainCoverImage = `../useruploads/article_images/${coverPhoto}`
                    // }else{
                    //     mainCoverImage = `../images/articleImages/8.jpg`
                    // }
                    mainCoverImage = `../images/articleImages/8.jpg`


                    previewHead.setAttribute("style", `background-image: url(${mainCoverImage}); background-size: cover; background-repeat: no-repeat;`)
                    let DateUploaded = "N/A"
                    let SubmittedDate = "N/A"
                    let ReviewedDate = "N/A"
                    let AcceptedDate = "N/A"
                    let PublishedDate = "N/A"

                    
                if(Article[0].date_uploaded != null && Article[0].date_uploaded != "" && Article[0].date_uploaded){
                    DateUploaded = formatTimestamp(Article[0].date_uploaded)
                    }

                    if(Article[0].date_submitted != null && Article[0].date_submitted != "" && Article[0].date_submitted){
                    SubmittedDate = formatTimestamp(Article[0].date_submitted)
                    }

                    if(Article[0].date_reviewed != null && Article[0].date_reviewed != "" && Article[0].date_reviewed){
                    ReviewedDate = formatTimestamp(Article[0].date_reviewed)
                    }

                    if(Article[0].date_accepted != null && Article[0].date_accepted != "" && Article[0].date_accepted){
                    AcceptedDate = formatTimestamp(Article[0].date_accepted)
                    }

                    if(Article[0].date_published != null && Article[0].date_published != "" && Article[0].date_published){
                   PublishedDate = formatTimestamp(Article[0].date_published)
                    }
                    const buffer = Article[0].buffer

                    document.addEventListener("DOMContentLoaded", function () {
                      // Function to create and add a meta tag
                      function addMetaTag(property, content) {
                        const metaTag = document.createElement("meta");
                        metaTag.setAttribute("property", property);
                        metaTag.setAttribute("content", content);
                        document.head.appendChild(metaTag);
                      }

                      // Add the meta tags
                      addMetaTag("og:title", `${ArticleTitle}`);

                      // Assuming 'articleUrl' is defined or you can replace it with the actual URL
                        const articleUrl = window.location.href; // You can replace this with your article URL logic
                        
                      const encodedUrl = `https:/asfirj.org/content?sid=${articeID}`;
                      addMetaTag("og:url", encodedUrl);
                    });

                    const correspondingAuthorsEmailContainer = document.getElementById("correspondingAuthorsEmail")
                    correspondingAuthorsEmailContainer.innerHTML += ` <a style="color:#333;" href="mailto:${correspondingAuthorsEmail}">${correspondingAuthorsEmail}</a>`
                    
                    const hyperlinkContainer = document.getElementById("hyperlink")
                    if(hyperLink != null && hyperLink !== null && hyperLink !== "null"){
                    hyperlinkContainer.innerHTML += `<a style="color:#333;" href="${hyperLink}">${hyperLink}</a>`
                    }else{
                         hyperlinkContainer.style.display = "none"
                    }
                   

                    viewCountContainer.innerText = `${viewsCount} Views`
                    downloadsCountContainer.innerText = `${DownloadsCount} Downloads`
                     issueNumber.innerText = `Issue Number: ${Issue}`
                     pageNumber.innerText = `Page Number: ${Page}`
                     doiNumber.innerText = `DOI Number: ${Doi}`
                     dateSubmitted.innerText = `Date Submitted: ${SubmittedDate}`
                     dateReviewed.innerText = `Date Revised: ${ReviewedDate}`
                     dateAccepted.innerText = `Date Accepted: ${AcceptedDate}`
                     datePublished.innerText = `Date Published: ${PublishedDate}`
                    // Set the download links for the articles 
                    downloadLinks.forEach(link =>{
                        link.setAttribute("href", `../useruploads/manuscripts/${ManuscriptFile}`)
                        link.setAttribute("download", `${ArticleTitle}.pdf`)

                        link.addEventListener("click", function(){
                            DownloadItem(buffer)
                        })
                    })

                    // Add the HTML content to the page 
                    manu_title.innerText = ArticleTitle
                    published_date.innerText = `${DateUploaded}`

                    // gEt the authors 
                    fetch(`${EndPoint}/allAuthors.php?articleID=${buffer}`, {
                        method: "GET"
                    }).then(res => res.json())
                        .then(data => {
                            if (data) {
                                const AllAuthors = data.authorsList
                                let AuthorsName = ""

                                AllAuthors.forEach(author => {
                                    // const AuthorsFullname = `${author.authors_prefix} ${author.authors_firstname} ${author.authors_middlename} ${author.authors_lastname}, `
                                    const AuthorsFullname = `${author.authors_fullname} `
                                    authorsListBottom.innerHTML += `<li> ${AuthorsFullname} </li>`

                                })
                                for(var i=0; i < AllAuthors.length; i++){
                                    if(i < AllAuthors.length - 1){
                                        AuthorsName += `${AllAuthors[i].authors_fullname}, `

                                    }else{
                                        AuthorsName += `${AllAuthors[i].authors_fullname}.`
                                    }
                                }

                                authorsContainerTop.innerText = AuthorsName

                            } else {
                                console.log("Server Error")
                            }
                        })

                    // Parse the Quill content from the JSON data
                                    
                    const quillContent = JSON.parse(unstructuredAbstract);
                    const quillContent2 = JSON.parse(AbstractDiscussoin);

                    // Create a Quill instance in "read-only" mode to render the content as HTML
                    const contentDiv = document.getElementById('content');
                    // const abstractDIV = document.getElementById("abstract")

                    function renderQuillAsHTML(divId, deltaContent) {
                        // Create a Quill instance in a temporary div
                        const tempDiv = document.createElement('div');
                        const quill = new Quill(tempDiv, {
                            theme: 'snow',
                            modules: { toolbar: false },
                            readOnly: true,
                        });

                        // Set the content as Quill Delta and extract the HTML
                        quill.setContents(deltaContent);

                        // Get the innerHTML from the Quill editor
                        const htmlContent = tempDiv.innerHTML;
                        const toDisplay = document.getElementById(divId)

                        // Render the extracted HTML into the specified div
                        toDisplay.innerHTML = htmlContent;
                    }

                    // Render the Quill content as HTML in the "content" div
                    renderQuillAsHTML('content', quillContent);
                    const abstractHeader = document.getElementById("abstractHeader")
                    abstractHeader.style.display = "none"

                   
                    if(quillContent2.length > 0){
                    abstractHeader.style.display = "block"
                    renderQuillAsHTML('abstract', quillContent2)
                    }

                } else {
                    alert("File Not found on server")
                }
            }
        })
}


export {
    getSupplement
}
