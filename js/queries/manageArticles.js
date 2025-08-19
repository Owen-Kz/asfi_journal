import { EndPoint } from "../constants.js"
import { UpdateManageArticles } from "../manageArticleList.js"
import { GetCookie } from "../setCookie.js"
import { CreateAuthorsOptionsManagement, CreateTypeOptionsManagement } from "./filterManagement.js"
import { articlesNavigation } from "./articlesNavigation.js";

const manageData = GetCookie("manageData")

if(!manageData){
    window.location.href = "../../manuscriptPortal/verify"
}

const search = document.getElementById("search")
const searchArticle = document.getElementById("searchArticle")

let Limit = 6

// Function to get page number from URL query parameters
function getPageFromQuery() {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page');
    return page ? parseInt(page) : 1;
}

function ArticlePageManagement(page){
    // Get the actual page from query parameters if not provided
    const currentPage = page || getPageFromQuery();
    
    fetch(`${EndPoint}/allArticles.php?page=${currentPage}&limit=${Limit}`,{
        method: "GET"
    }).then(res => res.json())
    .then(data =>{
        if(data){
            const ArticleLst = data.articlesList;
            const totalPages = data.totalPages;
            UpdateManageArticles(ArticleLst, currentPage, totalPages);
            articlesNavigation(new Number(totalPages), new Number(currentPage));
            
            // Update URL to reflect current page without full page reload
            const url = new URL(window.location);
            url.searchParams.set('page', currentPage);
            window.history.replaceState({}, '', url);
        } else {
            console.log("NO Data object");
        }
    }).catch(error => {
        console.error("Fetch error:", error);
    });

    // Search Articles 
    if(searchArticle){
        searchArticle.addEventListener("submit", async function(e){
            e.preventDefault();
            const searchPage = getPageFromQuery(); // Get current page for search
            
            if(search.value !== "" && search.value !== " "){
                await fetch(`${EndPoint}/allArticles.php?page=${searchPage}&limit=${Limit}&k=${search.value}`,{
                    method: "GET"
                }).then(res => res.json())
                .then(data =>{
                    if(data){
                        const ArticleLst = data.articlesList;
                        UpdateManageArticles(ArticleLst);
                    } else {
                        console.log("NO Data object");
                    }
                });
            } else {
                fetch(`${EndPoint}/allArticles.php?page=${searchPage}&limit=${Limit}`,{
                    method: "GET"
                }).then(res => res.json())
                .then(data =>{
                    if(data){
                        const ArticleLst = data.articlesList;
                        UpdateManageArticles(ArticleLst);
                    } else {
                        console.log("NO Data object");
                    }
                });
            }
        });
    }
}

// Initialize authors dropdown
const authorsOptions = document.getElementById("authorsOptionManagement");
if(authorsOptions){
    CreateAuthorsOptionsManagement().then(authors => {
        authors.forEach(author => {
            authorsOptions.innerHTML += `<option value="${author}">${author}</option>`;    
        });
    });
}

CreateTypeOptionsManagement();

// Start with the page from URL query parameter
ArticlePageManagement(getPageFromQuery());

export {
    ArticlePageManagement
}