import { submissionsEndpoint } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { GetCookie } from "../setCookie.js";
import { GetAccountData } from "./accountData.js";

const userID = GetCookie("user");
const UserData = await GetAccountData(userID);
const user = UserData.email;
const ArticlesContainer = document.getElementById("manuscriptsContainer");
const emptyState = document.getElementById("emptyState");

if(user){
    fetch(`https://greek.asfirj.org/backend/accounts/manuscriptsCoAuthored.php?u_id=${user}`, {
        method: "POST",
        body: JSON.stringify({user: user}),
        headers: {
            "Content-type": "application/JSON"
        }
    }).then(res => res.json())
    .then(data => {
        if(data.error){
            console.log(data.error);
            ArticlesContainer.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-red-600">
                        Error loading co-authored manuscripts. Please try again later.
                    </td>
                </tr>`;
        } else {
            const articlesList = data.articles;
            
            if(articlesList && articlesList.length > 0){
                ArticlesContainer.innerHTML = ''; // Clear any existing content
                
                articlesList.forEach(article => {
                    const ArticlesInfo = article;
                    let StatusMain = "";
                    let statusColor = "bg-gray-100 text-gray-800";
                    
                    if(ArticlesInfo.status === "returned_for_revision") {
                        StatusMain = "Returned For Revision";
                        statusColor = "bg-yellow-100 text-yellow-800";
                    } else if(ArticlesInfo.status === "submitted_for_review" || ArticlesInfo.status === "review_submitted" || ArticlesInfo.status === "revision_submitted") {
                        StatusMain = "Under Review";
                        statusColor = "bg-blue-100 text-blue-800";
                    } else if(ArticlesInfo.status === "submitted") {
                        StatusMain = "Submitted";
                        statusColor = "bg-purple-100 text-purple-800";
                    } else if(ArticlesInfo.status === "accepted") {
                        StatusMain = "Accepted";
                        statusColor = "bg-green-100 text-green-800";
                    } else {
                        StatusMain = ArticlesInfo.status;
                    }
                    
                    ArticlesContainer.innerHTML += `
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col space-y-2">
                                    <a href="mailto:submissions@asfirj.org" 
                                       class="inline-flex items-center text-xs text-primary hover:text-purple-800 transition-colors">
                                        <i class="bi bi-envelope mr-1"></i> Contact Journal
                                    </a>
                                    <span class="status-badge ${statusColor}">
                                        ${StatusMain}
                                    </span>
                                    <a href="../content?a=${ArticlesInfo.revision_id}" 
                                       class="inline-flex items-center text-xs text-gray-600 hover:text-primary transition-colors mt-2">
                                        <i class="bi bi-eye mr-1"></i> View submission
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                ${ArticlesInfo.revision_id}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${ArticlesInfo.title}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                ${ArticlesInfo.corresponding_authors_email}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                ${formatTimestamp(ArticlesInfo.date_submitted)}
                            </td>
                        </tr>`;
                });
            } else {
                // Show empty state
                ArticlesContainer.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <i class="bi bi-people text-4xl mb-3"></i>
                                <p class="text-lg">No co-authored manuscripts found</p>
                                <p class="text-sm mt-1">You haven't been added as a co-author on any manuscripts yet.</p>
                            </div>
                        </td>
                    </tr>`;
            }
        }
    }).catch(error => {
        console.error("Error fetching co-authored manuscripts:", error);
        ArticlesContainer.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-red-600">
                    Network error. Please check your connection and try again.
                </td>
            </tr>`;
    });
} else {
    console.log("Not Logged In");
    ArticlesContainer.innerHTML = `
        <tr>
            <td colspan="5" class="px-6 py-4 text-center text-red-600">
                Please log in to view your co-authored manuscripts.
            </td>
        </tr>`;
}