import { EndPoint, GetParameters } from "../constants.js";
import { getURL } from "../getURL.js";
import { UpdateIssues } from "../updateIssuesList.js";
import { articlesNavigation } from "./articlesNavigation.js";

const search = document.getElementById("search");
const searchArticle = document.getElementById("searchArticle");

const url = getURL();
const Limit = (url === "/asfi_journal/" || url === "/") ? 3 : 6;

const currentLocationURL = window.location.href;
const newpage = GetParameters(currentLocationURL).get("page") || 1;

// Run the function immediately
// ArticlePage(newpage);

async function ArticlePage(page) {
    try {
        const response = await fetch(`${EndPoint}/forIssues/allIssues.php?page=${page}&limit=${Limit}`);
        const data = await response.json();

        if (data?.articlesList) {
            console.log(data);
            const { articlesList, currentPage, totalPages } = data;
            UpdateIssues(articlesList, Number(currentPage), Number(totalPages));
            articlesNavigation(Number(totalPages), Number(currentPage));
        } else {
            console.warn("No data received.");
        }
    } catch (error) {
        console.error("Error fetching articles:", error);
    }
}

export { ArticlePage };
