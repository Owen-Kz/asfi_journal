import { EndPoint } from "../constants.js"
import { formatTimestamp } from "../formatDate.js";
import { DownloadItem } from "./downloadCount.js";

// --- CSS INJECTOR (Ensures styles match the RichTextViewer exactly) ---
const injectStyles = () => {
    if (document.getElementById('rich-text-viewer-styles')) return;
    const style = document.createElement('style');
    style.id = 'rich-text-viewer-styles';
    style.innerHTML = `
        .rich-content-container {
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.6;
            font-family: 'Aptos', 'Arial', sans-serif;
            color: #1a1a1a;
            width: 100%;
        }
        .mode-delta { white-space: pre-wrap; }
        .mode-html { white-space: normal; }
        .rich-content-container p { margin: 0 0 0.5rem 0; min-height: 1.2em; width: 100%; }
        .rich-content-container img { max-width: 100%; height: auto; display: block; margin: 1rem 0; border-radius: 4px; }
        .rich-content-container sup { font-size: 0.75em; vertical-align: super; line-height: 0; }
        .rich-content-container sub { font-size: 0.75em; vertical-align: sub; line-height: 0; }
        .rich-content-container .delta-inline-bg { padding: 1px 3px; border-radius: 2px; }
        .rich-content-container blockquote { border-left: 4px solid #3b82f6; padding-left: 1rem; margin: 1rem 0; font-style: italic; color: #4b5563; }
        .rich-content-container ul, .rich-content-container ol { padding-left: 2rem; margin: 8px 0; }
    `;
    document.head.appendChild(style);
};
injectStyles();

// --- DELTA CONVERTER LOGIC (Vanilla JS version of the React logic) ---
function convertDeltaToHtml(delta) {
    try {
        let parsed = null;
        if (typeof delta === 'string') {
            const trimmed = delta.trim();
            if (trimmed.startsWith('[{"')) parsed = JSON.parse(`{"ops":${trimmed}}`);
            else if (trimmed.startsWith('{"ops":')) parsed = JSON.parse(trimmed);
            else parsed = JSON.parse(trimmed);
        } else if (Array.isArray(delta)) {
            parsed = { ops: delta };
        } else {
            parsed = delta;
        }

        if (!parsed || !parsed.ops) return String(delta);

        let html = '';
        let currentBlockOps = [];

        const renderInline = (op) => {
            if (op.insert && typeof op.insert === 'object') {
                if (op.insert.image) return `<img src="${op.insert.image}" alt="embedded image" />`;
                if (op.insert.video) return `<iframe src="${op.insert.video}" frameBorder="0" allowFullScreen width="100%" height="315"></iframe>`;
                return '';
            }
            let text = op.insert;
            if (typeof text !== 'string' || text === '\n') return '';

            const attrs = op.attributes || {};
            let styles = [];
            let classes = [];

            if (attrs.color && attrs.color !== 'windowtext') styles.push(`color: ${attrs.color}`);
            if (attrs.background) {
                styles.push(`background-color: ${attrs.background}`);
                classes.push('delta-inline-bg');
            }
            if (attrs.size) styles.push(`font-size: ${attrs.size}`);

            let content = text;
            if (attrs.bold) content = `<strong>${content}</strong>`;
            if (attrs.italic) content = `<em>${content}</em>`;
            if (attrs.underline) content = `<u>${content}</u>`;
            if (attrs.strike) content = `<strike>${content}</strike>`;
            if (attrs.script === 'super') content = `<sup>${content}</sup>`;
            if (attrs.script === 'sub') content = `<sub>${content}</sub>`;

            const styleAttr = styles.length > 0 ? ` style="${styles.join('; ')}"` : '';
            const classAttr = classes.length > 0 ? ` class="${classes.join(' ')}"` : '';

            if (styleAttr || classAttr) content = `<span${classAttr}${styleAttr}>${content}</span>`;
            if (attrs.link) content = `<a href="${attrs.link}" target="_blank" style="color:#2563eb;text-decoration:underline;">${content}</a>`;
            return content;
        };

        const flushBlock = (ops, blockAttrs = {}) => {
            let content = ops.map(op => renderInline(op)).join('');
            const styles = [];
            if (blockAttrs.align) styles.push(`text-align: ${blockAttrs.align}`);
            const styleAttr = styles.length > 0 ? ` style="${styles.join('; ')}"` : '';

            if (blockAttrs.header) return `<h${blockAttrs.header}${styleAttr}>${content || '&nbsp;'}</h${blockAttrs.header}>`;
            if (blockAttrs.blockquote) return `<blockquote${styleAttr}>${content || '&nbsp;'}</blockquote>`;
            if (blockAttrs.list) return `<li data-list="${blockAttrs.list}"${styleAttr}>${content || '&nbsp;'}</li>`;
            return `<p${styleAttr}>${content || '&nbsp;'}</p>`;
        };

        parsed.ops.forEach(op => {
            if (typeof op.insert === 'string') {
                const parts = op.insert.split('\n');
                parts.forEach((part, index) => {
                    if (index < parts.length - 1) {
                        if (part) currentBlockOps.push({ ...op, insert: part });
                        html += flushBlock(currentBlockOps, op.attributes || {});
                        currentBlockOps = [];
                    } else if (part) {
                        currentBlockOps.push({ ...op, insert: part });
                    }
                });
            } else {
                currentBlockOps.push(op);
            }
        });

        if (currentBlockOps.length > 0) html += flushBlock(currentBlockOps, {});
        return html.replace(/(<li data-list="ordered">.*<\/li>)+/g, m => `<ol>${m}</ol>`)
                   .replace(/(<li data-list="bullet">.*<\/li>)+/g, m => `<ul>${m}</ul>`);
    } catch (e) {
        return String(delta);
    }
}

// Helper function to detect format
function detectContentType(content) {
    if (!content) return 'empty';
    const trimmed = typeof content === 'string' ? content.trim() : '';
    if (trimmed.startsWith('[{"') || trimmed.startsWith('{"ops":')) return 'delta';
    if (trimmed.startsWith('<') && (trimmed.includes('</') || trimmed.includes('/>'))) return 'html';
    return 'text';
}

// Simplified renderContent function
function renderContent(divId, content) {
    const toDisplay = document.getElementById(divId);
    if (!toDisplay) return Promise.resolve();

    toDisplay.innerHTML = `<div class="text-center p-3"><div class="spinner-border spinner-border-sm text-primary"></div></div>`;

    return new Promise((resolve) => {
        setTimeout(() => {
            const type = detectContentType(content);
            toDisplay.classList.add('rich-content-container');

            if (type === 'delta') {
                toDisplay.classList.add('mode-delta');
                toDisplay.classList.remove('mode-html');
                toDisplay.innerHTML = convertDeltaToHtml(content);
            } else if (type === 'html') {
                toDisplay.classList.add('mode-html');
                toDisplay.classList.remove('mode-delta');
                toDisplay.innerHTML = content;
            } else {
                toDisplay.innerHTML = content ? `<p>${content}</p>` : '<p class="text-muted">No content available</p>';
            }
            resolve();
        }, 10);
    });
}

// --- REST OF YOUR FUNCTIONS (UNCHANGED BUT CLEANED) ---

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
    // Show loaders...
    ['abstract', 'content'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.innerHTML = `<div class="text-center p-5"><div class="spinner-border text-primary"></div><p class="mt-2">Loading...</p></div>`;
    });

    fetch(`${EndPoint}/retrieveArticle.php?q=${articeID}`, { method: "GET" })
        .then(res => res.json())
        .then(data => {
            if (data.articleData && data.articleData.length > 0) {
                const Article = data.articleData;
                
                // PHASE 1: Basic Info & Links
                const ArticleTitle = Article[0].manuscript_full_title;
                const ManuscriptFile = Article[0].manuscript_file;
                const buffer = Article[0].buffer;
                manu_title.innerText = ArticleTitle;
                published_date.innerText = Article[0].date_uploaded ? formatTimestamp(Article[0].date_uploaded) : "N/A";

                downloadLinks.forEach(link => {
                    link.setAttribute("href", `../useruploads/manuscripts/${ManuscriptFile}`);
                    link.setAttribute("download", `${ArticleTitle}.pdf`);
                    link.onclick = () => DownloadItem(buffer);
                });

                // PHASE 2: Cover & Metadata
                 const coverPhoto = Article[0].manuscriptPhoto;
                 console.log("ARTICLE TYPE", Article[0].is_old_publication)
                const mainCoverImage = `../images/articleImages/8.jpg`;
                document.getElementById("previewHead").style.backgroundImage = `url(${mainCoverImage})`;
                
                loadAuthors(buffer);
                setTimeout(() => loadMetadata(Article[0]), 100);

                // PHASE 3: Render Content (Handle both Quill and RichText HTML)
                setTimeout(() => {
                    renderContent('content', Article[0].unstructured_abstract);
                    if (Article[0].abstract_discussion) {
                        document.getElementById("abstractHeader").style.display = "block";
                        renderContent('abstract', Article[0].abstract_discussion);
                    }
                }, 200);
                
            } else {
                alert("File Not found on server");
            }
        });
}

function loadAuthors(buffer) {
    fetch(`${EndPoint}/allAuthors.php?articleID=${buffer}`).then(res => res.json()).then(data => {
        if (data && data.authorsList) {
            const list = data.authorsList;
            authorsListBottom.innerHTML = list.map(a => `<li>${a.authors_fullname}</li>`).join('');
            authorsContainerTop.innerText = list.map(a => a.authors_fullname).join(', ') + '.';
        }
    });
}

function loadMetadata(item) {
    viewCountContainer.innerText = `${item.views_count} Views`;
    downloadsCountContainer.innerText = `${item.downloads_count} Downloads`;
    issueNumber.innerText = `Issue Number: ${item.issues_number}`;
    pageNumber.innerText = `Page Number: ${item.page_number}`;
    doiNumber.innerText = `DOI Number: ${item.doi_number}`;
    dateSubmitted.innerText = `Date Submitted: ${item.date_submitted ? formatTimestamp(item.date_submitted) : "N/A"}`;
    dateReviewed.innerText = `Date Revised: ${item.date_reviewed ? formatTimestamp(item.date_reviewed) : "N/A"}`;
    dateAccepted.innerText = `Date Accepted: ${item.date_accepted ? formatTimestamp(item.date_accepted) : "N/A"}`;
    datePublished.innerText = `Date Published: ${item.date_published ? formatTimestamp(item.date_published) : "N/A"}`;

    document.getElementById("correspondingAuthorsEmail").innerHTML += ` <a style="color:#333;" href="mailto:${item.corresponding_authors_email}">${item.corresponding_authors_email}</a>`;
    const hyperLink = item.hyperlink_to_others;
    if(hyperLink && hyperLink !== "null") {
        document.getElementById("hyperlink").innerHTML += `<a style="color:#333;" href="${hyperLink}">${hyperLink}</a>`;
    }
}

export { getSupplement }