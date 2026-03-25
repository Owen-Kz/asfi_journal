import { formatTimestamp } from "./formatDate.js";

const articleListContainer = document.getElementById("articleListContainer");

const getCoverImage = (article) => {
    const { manuscriptPhoto: photo, is_old_publication: isOld } = article;
    if (!photo) return `https://res.cloudinary.com/dvm0bs013/image/upload/v1738234900/asfischolar_asbtdc.jpg`;
    
    return isOld === "yes" 
        ? `https://asfirj.org/useruploads/article_images/${photo}`
        : `https://process.asfirj.org/useruploads/article_images/${photo}`;
};

async function UpdateIssues(articleList) {
    if (!articleListContainer) return;
    if (!articleList?.length) {
        articleListContainer.innerHTML = "<p>No articles available.</p>";
        return;
    }

    // Optimization: If authors aren't in the object, the backend should be updated 
    // to include them in the allIssues.php response to avoid these 10+ pings.
    const articlesHTML = articleList.map((article) => {
        const coverImage = getCoverImage(article);
        const formattedDate = formatTimestamp(article.date_published || article.date_uploaded);
        // Fallback if authors weren't joined in the backend query
        const authorsName = article.authors_fullname || "Research Team"; 

        const editorsChoiceBadge = article.is_editors_choice === "yes"
            ? `<span class="editchoice"><svg width="20" viewBox="0 0 24 24" fill="#4d91f7"><path d="M19.965 8.521C19.988 8.347 20 8.173 20 8c0-2.379-2.143-4.288-4.521-3.965C14.786 2.802 13.466 2 12 2s-2.786.802-3.479 2.035C6.138 3.712 4 5.621 4 8c0 .173.012.347.035.521C2.802 9.215 2 10.535 2 12s.802 2.785 2.035 3.479A3.976 3.976 0 0 0 4 16c0 2.379 2.138 4.283 4.521 3.965C9.214 21.198 10.534 22 12 22s2.786-.802 3.479-2.035C17.857 20.283 20 18.379 20 16c0-.173-.012-.347-.035-.521C21.198 14.785 22 13.465 22 12s-.802-2.785-2.035-3.479zm-9.01 7.895-3.667-3.714 1.424-1.404 2.257 2.286 4.327-4.294 1.408 1.42-5.749 5.706z"/></svg> Editor's Choice</span>`
            : "";

        const openAccessBadge = article.is_open_access === "yes"
            ? `<span class="openaccess"><img src="../images/20181007070735!Open_Access_logo_PLoS_white.svg" width="10" alt=""> Open Access</span>`
            : "";

        return `
            <div class="issue-item" style="display: flex;">
                <div class="issue-image" style="background-image: url('${coverImage}');" loading="lazy"></div>
                <div class="issue-content">
                    <div class="doi-access-wrapper">
                        <span class="item-category">${article.article_type}</span>
                        <span class="articleSpan">${openAccessBadge} ${editorsChoiceBadge}</span>
                    </div>
                    <a href="../content?sid=${article.buffer}" class="issue-item__title">
                        <h3 lang="en">${article.manuscript_full_title}</h3>
                    </a>
                    <div class="loa comma">
                        <p class="article-authors" title="${authorsName}">${authorsName}</p>
                    </div>
                    <ul class="rlist--inline separator issue-item__details">
                        <li><label>First Published:</label><span class="bold">&nbsp;${formattedDate}</span></li>
                    </ul>
                    <div class="content-item-format-links">
                        <button class="toggle-format-links-btn" onclick="toggleFormatLinks(this)">Show Options ▼</button>
                        <ul class="format-links">
                            <li><a href="../content?sid=${article.buffer}#content">Abstract</a></li>
                            <li><a href="../content?sid=${article.buffer}#fulltext">Full text</a></li>
                            <li><a href="https://asfirj.org/useruploads/manuscripts/${article.manuscript_file}" target="_blank">PDF</a></li>
                            <li class="stats"><span class="stat-count">${article.views_count}</span> Views</li>
                            <li class="stats"><span class="stat-count">${article.downloads_count}</span> Downloads</li>
                            <li><button class="share-btn" data-id="${article.buffer}">Share</button></li>
                        </ul>
                    </div>
                </div>
            </div>`;
    }).join('');

    articleListContainer.innerHTML = articlesHTML;
}

export { UpdateIssues };