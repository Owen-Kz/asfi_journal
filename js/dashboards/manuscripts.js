import { submissionsEndpoint } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { GetCookie } from "../setCookie.js";
import { GetAccountData } from "./accountData.js";

const userID = GetCookie("user")
const ArticlesContainer = document.getElementById("manuscriptsContainer")
const emptyState = document.getElementById("emptyState")

if(userID){
    const UserData = await GetAccountData(userID)
    const user = UserData.email

    fetch(`https://greek.asfirj.org/backend/accounts/manuscripts.php`, {
        method:"POST",
        body:JSON.stringify({user:user}),
        headers:{
            "Content-type" : "application/JSON"
        }
    }).then(res => res.json())
    .then(data=>{
        if(data.error){
            console.log(data.error)
            ArticlesContainer.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-red-600">
                        Error loading manuscripts. Please try again later.
                    </td>
                </tr>`
        } else {
            const articlesList = data.articles
            
            if(articlesList.length > 0){
                articlesList.forEach(article => {
                    const ArticlesInfo = article
                    let RevisionAction = ""
                    let StatusMain = ""
                    let viewSubmission = ""
                    let statusColor = "bg-gray-200 text-gray-800"
                    
                    if(ArticlesInfo.status === "returned_for_revision"){
                        viewSubmission = ``
                        RevisionAction = `
                            <a href="https://process.asfirj.org/uploadManuscript?a=${ArticlesInfo.revision_id}&_uid=${userID}&revise=true" 
                               class="inline-flex items-center px-3 py-1 bg-primary text-white text-sm rounded-md hover:bg-purple-800 transition-colors">
                                Submit Revision
                            </a>`
                        StatusMain = "Returned For Revision"
                        statusColor = "bg-yellow-100 text-yellow-800"
                    } else if(ArticlesInfo.status === "returned_for_correction"){
                        viewSubmission = ``
                        RevisionAction = `
                            <a href="https://process.asfirj.org/uploadManuscript?a=${ArticlesInfo.revision_id}&_uid=${userID}&correct=true" 
                               class="inline-flex items-center px-3 py-1 bg-primary text-white text-sm rounded-md hover:bg-purple-800 transition-colors">
                                Submit Correction
                            </a>`
                        StatusMain = "Returned For Correction"
                        statusColor = "bg-yellow-100 text-yellow-800"
                    } else if(ArticlesInfo.status === "correction_saved"){
                        viewSubmission = ``
                        RevisionAction = `
                            <a href="https://process.asfirj.org/uploadManuscript?a=${ArticlesInfo.revision_id}&_uid=${userID}&correct=true" 
                               class="inline-flex items-center px-3 py-1 bg-primary text-white text-sm rounded-md hover:bg-purple-800 transition-colors">
                                Continue Correction
                            </a>`
                        StatusMain = "Returned For Correction"
                        statusColor = "bg-yellow-100 text-yellow-800"
                    } else if(ArticlesInfo.status === "submitted_for_review" || ArticlesInfo.status === "review_submitted"){
                        RevisionAction = ``
                        StatusMain = "Under Review"
                        statusColor = "bg-blue-100 text-blue-800"
                        viewSubmission = `
                            <a href="../content?a=${ArticlesInfo.revision_id}" 
                               class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded-md hover:bg-gray-300 transition-colors">
                                View Submission
                            </a>`
                    } else if(ArticlesInfo.status === "revision_submitted"){
                        RevisionAction = ``
                        StatusMain = "Revision Submitted"
                        statusColor = "bg-blue-100 text-blue-800"
                        viewSubmission = `
                            <a href="../content?a=${ArticlesInfo.revision_id}" 
                               class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded-md hover:bg-gray-300 transition-colors">
                                View Submission
                            </a>`
                    } else if(ArticlesInfo.status === "saved_for_later" || ArticlesInfo.status === "revision_saved"){
                        RevisionAction = `
                            <a href="https://process.asfirj.org/uploadManuscript?a=${ArticlesInfo.revision_id}&_uid=${userID}" 
                               class="inline-flex items-center px-3 py-1 bg-primary text-white text-sm rounded-md hover:bg-purple-800 transition-colors">
                                Continue Submission
                            </a>`
                        viewSubmission = ``
                        StatusMain = "Manuscript Saved as Draft"
                        statusColor = "bg-gray-200 text-gray-800"
                    } else if(ArticlesInfo.status === "submitted"){
                        RevisionAction = ``
                        viewSubmission = `
                            <a href="../content?a=${ArticlesInfo.revision_id}" 
                               class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded-md hover:bg-gray-300 transition-colors">
                                View Submission
                            </a>`
                        StatusMain = "Submitted"
                        statusColor = "bg-blue-100 text-blue-800"
                    } else if(ArticlesInfo.status === "accepted"){
                        RevisionAction = ``
                        viewSubmission = `
                            <a href="../content?a=${ArticlesInfo.revision_id}" 
                               class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded-md hover:bg-gray-300 transition-colors">
                                View Submission
                            </a>`
                        StatusMain = "Accepted By Editor"
                        statusColor = "bg-green-100 text-green-800"
                    } else {
                        RevisionAction = ``
                        viewSubmission = `
                            <a href="../content?a=${ArticlesInfo.revision_id}" 
                               class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 text-sm rounded-md hover:bg-gray-300 transition-colors">
                                View Submission
                            </a>`
                        StatusMain = `${ArticlesInfo.status}`
                        statusColor = "bg-gray-200 text-gray-800"
                    }
                    
                    ArticlesContainer.innerHTML += `
                        <tr class="table-row-hover">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="px-2 py-1 ${statusColor} text-xs font-medium rounded-full">
                                        ${StatusMain}
                                    </span>
                                </div>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    <a href="mailto:submissions@asfirj.org" 
                                       class="inline-flex items-center text-xs text-primary hover:text-purple-800">
                                        <i class="fa fa-envelope-o mr-1"></i> Contact Journal
                                    </a>
                                    ${viewSubmission}
                                    ${RevisionAction}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                ${ArticlesInfo.revision_id}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">${ArticlesInfo.title}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                ${formatTimestamp(ArticlesInfo.date_submitted)}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                ${formatTimestamp(ArticlesInfo.process_start_date)}
                            </td>
                        </tr>`
                })
            } else {
                ArticlesContainer.classList.add('hidden')
                emptyState.classList.remove('hidden')
            }
        }
    })
} else {
    console.log("Not Logged In")
    ArticlesContainer.innerHTML = `
        <tr>
            <td colspan="5" class="px-6 py-4 text-center text-red-600">
                Please log in to view your manuscripts.
            </td>
        </tr>`
}