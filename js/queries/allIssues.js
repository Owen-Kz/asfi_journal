import { EndPoint, GetParameters } from "../constants.js";
import { getURL } from "../getURL.js";
import { UpdateIssues } from "../updateIssuesList.js?v=a4lwwr";
import { articlesNavigation } from "./articlesNavigation.js";

const url = getURL();
const Limit = (url === "/asfi_journal/" || url === "/") ? 6 : 10;
const page = GetParameters(window.location.href).get("page") || 1;

async function ArticlePage(pageNumber = 1) {
    try {
        const response = await fetch(`${EndPoint}/forIssues/allIssues.php?page=${pageNumber}&limit=${Limit}`);
        if (!response.ok) throw new Error("Network response was not ok");
        
        const data = await response.json();
        if (data?.articlesList) {
            UpdateIssues(data.articlesList);
            articlesNavigation(Number(data.totalPages), Number(data.currentPage));
        }
    } catch (error) {
        console.error("Fetch error:", error);
    }
}

// Initialize
ArticlePage(page);

export { ArticlePage };