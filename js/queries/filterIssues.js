import { EndPoint } from "../constants.js";
import { UpdateIssues } from "../updateIssuesList.js?v=a4lwwr";
import { ArticlePage } from "./allIssues.js?v=a4lwwr";

const TypeContainer = document.getElementById("typeOption");
const authorsOptions = document.getElementById("authorsOption");
const searchForm = document.getElementById("searchArticle");
const searchField = document.getElementById("search");

// Improved performance for populating dropdowns
async function LoadFilterOptions() {
    try {
        const [authRes, typeRes] = await Promise.all([
            fetch(`${EndPoint}/authors.php`, { method: "POST" }),
            fetch(`${EndPoint}/articleType.php`, { method: "POST" })
        ]);

        const authorsData = await authRes.json();
        const typesData = await typeRes.json();

        if (authorsOptions && authorsData.authors) {
            authorsOptions.innerHTML = '<option value="all">Filter by Author</option>' + 
                authorsData.authors.map(a => `<option value="${a}">${a}</option>`).join('');
        }

        if (TypeContainer && typesData.types) {
            TypeContainer.innerHTML = '<option value="all">Filter by Type</option>' + 
                typesData.types.map(t => `<option value="${t}">${t}</option>`).join('');
        }
    } catch (e) { console.error("Filter load error", e); }
}

async function handleFilter(url, isAll = false) {
    if (isAll) {
        ArticlePage(1);
        return;
    }
    try {
        const res = await fetch(url);
        const data = await res.json();
        if (data.status === "success") UpdateIssues(data.articlesList);
    } catch (e) { console.error("Filter error", e); }
}

if (TypeContainer) {
    TypeContainer.addEventListener("change", () => 
        handleFilter(`${EndPoint}/forIssues/filterbyType.php?type=${TypeContainer.value}`, TypeContainer.value === "all")
    );
}

if (authorsOptions) {
    authorsOptions.addEventListener("change", () => 
        handleFilter(`${EndPoint}/forIssues/filterByAuthors.php?author=${authorsOptions.value}`, authorsOptions.value === "all")
    );
}

if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
        e.preventDefault();
        handleFilter(`${EndPoint}/forIssues/filterIssues.php?k=${searchField.value}`);
    });
}

// Initial load
LoadFilterOptions();