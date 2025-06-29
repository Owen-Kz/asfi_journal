import { GetParameters, submissionsEndpoint } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { GetKeywords } from "../forms/getKeywords.js";
// import { quill } from "../forms/quill.js";
const manu_title = document.getElementById("manu_title");
const published_date = document.getElementById("published_date")
// const authorsContainerTop = document.getElementById("authorsContainerTop")
const authorsListBottom = document.getElementById("authorsListBottom")
const filesContainer = document.getElementById("filesContainer")
const ArticleTypeContainer = document.getElementById("articleTypeContainer")
const DiscisplineContainer =  document.getElementById("disciplineContainer")
const statusContainer = document.getElementById("status")
const ArticleIdQuery = GetParameters(window.location.href).get("a")
const ActionsContainer = document.getElementById("action_container")

if(ArticleIdQuery){
    getSupplement(ArticleIdQuery)
}else{
    window.location.href = "../../dashboard/authordash/manuscripts"
}


function getSupplement(articeID) {
    fetch(`https://test.asfirj.org/backend/accounts/getArticleInfo.php`, {
        method:"POST",
        body:JSON.stringify({id:articeID}),
        headers:{
            "Content-type" : "application/JSON"
        }
    }).then(res => res.json())
        .then(async data => {
            if (data.articles) {
                const Article = data.articles

                if (Article) {
                    const ArticleTitle = Article.title
                    const ArticleType = Article.article_type
                    const coverLetter = Article.cover_letter_file
                    const discipline = Article.discipline
                    const ManuscriptFile = Article.manuscript_file
                    const Status = Article.status
                    const ManuscriptDocument = Article.document_file

                    
                
                    const unstructuredAbstract = Article.abstract
                    const status = Article.status
                    const correspondingAuthorsEmail = Article.corresponding_authors_email
                    const DateUploaded = formatTimestamp(Article.date_submitted)
                    let documentFile = ""
                    let DOCUMENTFILE = ""
                    let MANUSCRIPT_FILE = ""
                    if(Article.date_submitted < "2025-01-07"){
                     MANUSCRIPT_FILE = `https://test.asfirj.org/uploadedFiles/${ManuscriptFile}`
             
                    if (Article.document_file !== "dummy.pdf") {
                        documentFile = Article.document_file;
                        DOCUMENTFILE = `<a href="https://test.asfirj.org/uploadedFiles/${ManuscriptDocument}" style="color:#333; text-decoration: underline;" target=_blank>View Manuscript Document File</a>`;

                    }
                 }else{
                   
                    if(Article.manuscript_file && Article.manuscript_file !== null){
                     if(Article.manuscript_file.slice(0, 26) === 'https://res.cloudinary.com'){
                        MANUSCRIPT_FILE = `https://process.asfirj.org/doc?url=${Article.manuscript_file}`
                        }else{
                             MANUSCRIPT_FILE = `https://test.asfirj.org/uploadedFiles/${Article.manuscript_file}`
                        }
                    }else{
                        MANUSCRIPT_FILE = "#"
                    }
                        const filesArrayCont = []
                        const supplements = Article.supplementary_material
                        if(supplements) {
                        filesArrayCont.push(supplements)
                        }
                        const graphicAbstract = Article.graphic_abstract
                        if(graphicAbstract){
                        filesArrayCont.push(graphicAbstract)
                        }

                        
                        const figures = Article.figures
                        if(figures){
                        filesArrayCont.push(figures)
                        }
                        
                        const tables = Article.tables
                        if(tables){
                        filesArrayCont.push(tables)
                        }

                        const trackedManuscriptFile = Article.tracked_manuscript_file

                        if(trackedManuscriptFile){
                        filesArrayCont.push(trackedManuscriptFile)
                        }

                     const filesArray = filesArrayCont
                 
                      DOCUMENTFILE = "<b>Additional Document Files</b> (i.e supplementary materials, tables, figures, graphic abstract): "
                     for(let i = 0; i< filesArray.length; i++){
                        if(filesArray[i].slice(0, 26) === 'https://res.cloudinary.com'){
                             DOCUMENTFILE += `<br> <a href="https://process.asfirj.org/doc?url=${filesArray[i]}" style="color:#333; text-decoration: underline;" target=_blank>View ${filesArray[i].substring(filesArray[i].lastIndexOf("/") + 1)}</a>
                         `
                            }else{
                                DOCUMENTFILE += `<br> <a href="${filesArray[i]}" style="color:#333; text-decoration: underline;" target=_blank>View ${filesArray[i].substring(filesArray[i].lastIndexOf("/") + 1)}</a>`
                            }  
                   
                     }
                 }
                 let coverLetterMan = ""
                 if(Article.cover_letter_file.slice(0, 26) === 'https://res.cloudinary.com'){
                    coverLetterMan =  `<a href="https://process.asfirj.org/doc?url=${coverLetter}" style="color:#333; text-decoration: underline;" target=_blank>View Cover Letter</a>`
                 }else{
                    coverLetterMan = `<a href="https://test.asfirj.org/uploadedFiles/${coverLetter}" style="color:#333; text-decoration: underline;" target=_blank>View Cover Letter</a>`
                 }
                //  
                 
                    const ArticleID = Article.article_id
                    filesContainer.innerHTML += `${coverLetterMan}
                    <br>
                            <b>Manuscript File </b><i>a combination of all files submitted in PDF format, (i.e tables, figues, supplementary materials)</i>: <a href="${MANUSCRIPT_FILE}" style="color:#333; text-decoration: underline;" target=_blank>View Manuscript File</a>
                            <br>
                          
                            ${DOCUMENTFILE}`
                    const correspondingAuthorsEmailContainer = document.getElementById("correspondingAuthorsEmail")
                    correspondingAuthorsEmailContainer.innerHTML +=  ` <a style="color:#333;" href="mailto:${correspondingAuthorsEmail}">${correspondingAuthorsEmail}</a>`
                    ArticleTypeContainer.innerText  = ArticleType
                    DiscisplineContainer.innerText = discipline
            
                    // Add the HTML content to the page 
                    manu_title.innerText = ArticleTitle
                    published_date.innerText = `${DateUploaded}`

                    if(status === "returned_for_revision"){
                     
                        statusContainer.innerText= "Returned For Revision"

                    }else if(status === "returned_for_correction"){
                
                        statusContainer.innerText= "Returned For Correction"
                    }

                    if(status === "submitted_for_review" || status === "review_submitted" || status === "revision_submitted"){
                       
                        statusContainer.innerText= "Under Review"
               
                    }else if(status === "saved_for_later" || status === "revision_saved"){
                        statusContainer.innerText= "Manuscript Saved as Draft"
                    }else if(status === "submitted" ){
                   
                        statusContainer.innerText= "Submitted"
                    }else if(status === "correction_saved"){
                    
                        statusContainer.innerText= "Manuscript Saved as Draft"
                    }else if(status === "accepted"){
                    
                        statusContainer.innerText= "Approved By Editor"
                    }else{
                        RevisionAction = ``
                 
                        statusContainer.innerText= `${status}`
                    }


                    if(Status === "review_submitted"){
                        ActionsContainer.innerHTML += ` <br> <a href="../reviews?a=${articeID}" style="color: #333; text-decoration: underline; font-style: italic;">View Reviews</a> <br>`
                    }else{
                        ActionsContainer.innerHTML = `
                        <h4>Actions</h4>
                        <i>There are no actions available yet</i>`
                    }
                 
                    // gEt the authors 
                    fetch(`https://test.asfirj.org/backend/accounts/articleAuthors.php?articleID=${ArticleID}`, {
                        method: "GET"
                    }).then(res => res.json())
                        .then(data => {
                            if (data) {
                                const AllAuthors = data.authorsList
                                let AuthorsName = ""

                                // AllAuthors.forEach(author => {
                                 
                                //     const AuthorsFullname = `${author.authors_fullname} `
                                //     authorsListBottom.innerHTML += `<li style="padding:8px"> ${AuthorsFullname} </li>`

                                // })

                                for(var i=0; i < AllAuthors.length; i++){
                                    if(i < AllAuthors.length - 1){
                                        AuthorsName += `${AllAuthors[i].authors_fullname}, `

                                    }else{
                                        AuthorsName += `${AllAuthors[i].authors_fullname}.`
                                    }
                                }

                                 authorsListBottom.innerText = AuthorsName

                            } else {
                                console.log("Server Error")
                            }
                        })
                    
                        

                    // Parse the Quill content from the JSON data
                    const quillContent = JSON.parse(unstructuredAbstract);

                    // Create a Quill instance in "read-only" mode to render the content as HTML
                    const contentDiv = document.getElementById('content');

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

                        // Render the extracted HTML into the specified div
                        contentDiv.innerHTML = htmlContent;
                    }

                    // Render the Quill content as HTML in the "content" div
                    renderQuillAsHTML('content', quillContent);
                    const keywordsContainer = document.getElementById("keywordsContainer");
            
                    const keywords = await GetKeywords(articeID)
                    for(let i=0; i<keywords.length;i++){
                        if(i === (keywords.length - 1)){
                            keywordsContainer.innerHTML += `${keywords[i].keyword}`
                        }else{
                            keywordsContainer.innerHTML += `${keywords[i].keyword}, `
                        }
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
