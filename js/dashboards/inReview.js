import { submissionsEndpoint } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { GetCookie } from "../setCookie.js";
import { GetAccountData } from "./accountData.js";

const userID = GetCookie("user");
const UserData = await GetAccountData(userID);
const userId = UserData.email;
const ArticlesContainer = document.getElementById("manuscriptsContainer");
const emptyState = document.getElementById("emptyState");

if(userId){
    fetch(`https://greek.asfirj.org/backend/accounts/inReview.php?u_id=${userId}`, {
        method: "POST",
        body: JSON.stringify({user: userId}),
        headers: {
            "Content-type": "application/JSON"
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            const articlesList = data.articles;

            if(articlesList && articlesList.length > 0){
                ArticlesContainer.innerHTML = ''; // Clear loading message
                
                articlesList.forEach(article => {
                    fetch(`https://greek.asfirj.org/backend/accounts/getArticleInfo.php`, {
                        method: "POST",
                        body: JSON.stringify({id: article.revision_id}),
                        headers: {
                            "Content-type": "application/JSON"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data && data.articles){
                            const ArticlesInfo = data.articles;
                            let StatusMain = "";
                            let statusColor = "bg-gray-100 text-gray-800";
                            
                            if(ArticlesInfo.status === "accepted"){
                                StatusMain = "Submission Accepted";
                                statusColor = "bg-green-100 text-green-800";
                            } else if(ArticlesInfo.status === 'rejected'){
                                StatusMain = "Submission Rejected";
                                statusColor = "bg-red-100 text-red-800";
                            } else if(ArticlesInfo.status === 'review_submitted' || 
                                     ArticlesInfo.status === "submitted_for_review" || 
                                     ArticlesInfo.status === "review_invite_accepted"){
                                StatusMain = "Under Review";
                                statusColor = "bg-blue-100 text-blue-800";
                            } else {
                                StatusMain = ArticlesInfo.status;
                            }
                            
                            const formattedDate = formatTimestamp(ArticlesInfo.date_submitted);
                            
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
                                        <div class="text-xs text-gray-500 mt-1 flex items-center">
                                            <i class="bi bi-info-circle mr-1"></i>
                                            <span>Files archived for revision</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        ${formattedDate}
                                    </td>
                                </tr>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching article info:", error);
                    });
                });
            } else {
                // Show empty state
                ArticlesContainer.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <i class="bi bi-clipboard-x text-4xl mb-3"></i>
                                <p class="text-lg">No manuscripts with decisions yet</p>
                                <p class="text-sm mt-1">Manuscripts that receive editorial decisions will appear here.</p>
                            </div>
                        </td>
                    </tr>
                `;
            }
        } else {
            // Show error state
            ArticlesContainer.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center text-red-500">
                            <i class="bi bi-exclamation-triangle text-4xl mb-3"></i>
                            <p class="text-lg">Error loading manuscripts</p>
                            <p class="text-sm mt-1">${data.error || 'Please try again later'}</p>
                        </div>
                    </td>
                </tr>
            `;
        }
    })
    .catch(error => {
        console.error("Error fetching manuscripts:", error);
        ArticlesContainer.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-8 text-center">
                    <div class="flex flex-col items-center justify-center text-red-500">
                        <i class="bi bi-wifi-off text-4xl mb-3"></i>
                        <p class="text-lg">Network error</p>
                        <p class="text-sm mt-1">Please check your connection and try again</p>
                    </div>
                </td>
            </tr>
        `;
    });
} else {
    console.log("Not Logged in");
    ArticlesContainer.innerHTML = `
        <tr>
            <td colspan="4" class="px-6 py-8 text-center">
                <div class="flex flex-col items-center justify-center text-red-500">
                    <i class="bi bi-person-x text-4xl mb-3"></i>
                    <p class="text-lg">Please log in</p>
                    <p class="text-sm mt-1">You need to be logged in to view manuscripts</p>
                </div>
            </td>
        </tr>
    `;
}