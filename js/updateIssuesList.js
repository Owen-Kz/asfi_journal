
import { EndPoint } from "./constants.js";
import { formatTimestamp } from "./formatDate.js";
import { CreateAuthorsOptionsForIssues, CreateTypeOptionsForIssues } from "./queries/filterIssues.js";

const ArticleListContainer = document.getElementById("articleListContainer")
const ArticleListFront = document.getElementById("article_items_container")
const SliderListContainer = document.querySelector(".carousel-inner")
const indicators = document.querySelector(".carousel-indicators")

// const authorsOptions = document.getElementById("authorsOption")



// import { EndPoint } from "./constants.js";
// import { formatTimestamp } from "./formatDate.js";
// import { CreateAuthorsOptionsForIssues } from "./queries/filterIssues.js";

const articleListContainer = document.getElementById("articleListContainer");
const authorsOptions = document.getElementById("authorsOption");

// Load authors' options
(async function loadAuthorsOptions() {
    if (authorsOptions) {
        const authors = await CreateAuthorsOptionsForIssues();
        authorsOptions.innerHTML = authors.map(author => `<option value="${author}">${author}</option>`).join('');
    }
})();

async function fetchAuthors(articleId) {
    try {
        const response = await fetch(`${EndPoint}/allAuthors.php?articleID=${articleId}`);
        const data = await response.json();
        return data.authorsList.map(author => author.authors_fullname).join(', ') + '.';
    } catch (error) {
        console.error("Error fetching authors:", error);
        return "Unknown Author";
    }
}

async function UpdateIssues(articleList) {
    if (!articleListContainer) return;

    articleListContainer.innerHTML = "";

    if (!articleList.length) {
        articleListContainer.innerHTML = "<p>No articles available.</p>";
        return;
    }

    // Fetch authors for all articles concurrently
    const authorsData = await Promise.all(articleList.map(article => fetchAuthors(article.buffer)));

    let articlesHTML = "";

    articleList.forEach((article, index) => {
  
        const {
            manuscript_full_title: articleTitle,
            manuscript_file: articleFile,
            manuscriptPhoto: coverPhoto,
            buffer: articleId,
            date_published: mainPublishDate,
            date_uploaded,
            article_type: articleType,
            views_count: viewsCount,
            downloads_count: downloadsCount,
            is_editors_choice: isEditorsChoice,
            is_open_access: isOpenAccess
        } = article;

      let coverImage = `../useruploads/article_images/${coverPhoto}`? `../useruploads/article_images/${coverPhoto}`: `https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg`

        const formattedDate = formatTimestamp(mainPublishDate || date_uploaded);
        const authorsName = authorsData[index];

        const editorsChoiceBadge = isEditorsChoice === "yes"
            ? `<span class="editchoice">Editor's Choice <svg style="width:20px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479zm-9.01 7.895-3.667-3.714 1.424-1.404 2.257 2.286 4.327-4.294 1.408 1.42-5.749 5.706z" fill="#4d91f7"></path></svg></span>`
            : "";

        const openAccessBadge = isOpenAccess === "yes"
            ? `<span><img src="../images/20181007070735!Open_Access_logo_PLoS_white.svg" style="width:10px;" alt=""> Open Access</span>`
            : "";

        articlesHTML += `
            <div class="issue-item" style="display: flex;">
                <div style="width: 120px; margin-right: 10px; border-radius: 10px; border: 2px solid #310357; background-image: url(${coverImage}); background-size: cover;"></div>
                <div style="width: 100%;">
                    <div class="doi-access-wrapper">
                        <span class="item-category">${articleType}</span>
                        <span class="articleSpan">${openAccessBadge} ${editorsChoiceBadge}</span>
                    </div>
                    <a href="../content?sid=${articleId}" class="issue-item__title visitable">
                        <h3 lang="en" class="issue-item__title issue-item__title__en">${articleTitle}</h3>
                    </a>
                    <div class="loa comma">
                        <p class="article-authors" title="${authorsName}">${authorsName}</p>
                    </div>
                    <ul class="rlist--inline separator issue-item__details">
                        <li><label>First Published:</label><span class="bold">&nbsp;${formattedDate}</span></li>
                    </ul>
                    <div class="content-item-format-links">
                        <ul class="rlist--inline separator">
                            <li><a href="../content?sid=${articleId}#content">Abstract</a></li>
                            <li><a href="../content?sid=${articleId}#fulltext">Full text</a></li>
                            <li><a href="../useruploads/manuscripts/${articleFile}" target="_blank" class="downloadLink">PDF</a></li>
                            <li><a href="">References</a></li>
                            <li><span>${viewsCount}</span> Views</li>
                            <li><span>${downloadsCount}</span> Downloads</li>
                            <li class="shareButton">Share</li>
                        </ul>
                    </div>
                </div>
            </div>
        `;
    });

    articleListContainer.innerHTML = articlesHTML;
}


CreateTypeOptionsForIssues();

export {
    UpdateIssues,
}