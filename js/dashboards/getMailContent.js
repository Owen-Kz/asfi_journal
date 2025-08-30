import { GetParameters, processEndpoint, submissionsEndpoint } from "../constants.js";
import { formatTimestamp } from "../formatDate.js";
import { GetCookie } from "../setCookie.js";
import { GetAttachments } from "./getAttachments.js";
import { GetBCCEmails } from "./getBCCEmails.js";
import { GetCCEmails } from "./getCCEmails.js";

const user = GetCookie("user");
const emailContent = document.getElementById("emailContent");

async function GetEmailContent(emailID) {
    try {
        const BCCEMails = await GetBCCEmails(emailID);
        const CCEmails = await GetCCEmails(emailID);
        const Attachments = await GetAttachments(emailID);

        const response = await fetch(`https://greek.asfirj.org/backend/editors/emailContent.php?u_id=${user}&emailId=${emailID}`);
        const data = await response.json();
        
        if (data.emails) {
            const email = data.emails;
            const emailDate = new Date(email.date_sent);
            const formattedDate = emailDate.toLocaleDateString() + ' ' + emailDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            emailContent.innerHTML = `
                <div class="flex flex-col w-full">
                    <!-- Email Header -->
                    <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                        <button id="backButton" class="md:hidden p-2 rounded-lg hover:bg-gray-200">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <h3 class="text-lg font-semibold text-gray-800">${email.subject}</h3>
                    </div>
                    
                    <!-- Email Metadata -->
                    <div class="p-4 border-b border-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <span class="font-medium text-gray-800">From:</span> ${email.sender}
                            </div>
                            <div>
                                <span class="font-medium text-gray-800">To:</span> ${email.recipient}
                            </div>
                            <div>
                                <span class="font-medium text-gray-800">Date:</span> ${formattedDate}
                            </div>
                            ${email.article_id ? `
                            <div>
                                <span class="font-medium text-gray-800">Article ID:</span> ${email.article_id}
                            </div>
                            ` : ''}
                        </div>
                        
                        <!-- CC Emails -->
                        ${CCEmails.length > 0 ? `
                        <div class="mt-3">
                            <span class="font-medium text-gray-800">CC:</span>
                            <div class="flex flex-wrap gap-1 mt-1">
                                ${CCEmails.map(email => `<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">${email}</span>`).join('')}
                            </div>
                        </div>
                        ` : ''}
                        
                        <!-- BCC Emails -->
                        ${BCCEMails.length > 0 ? `
                        <div class="mt-3">
                            <span class="font-medium text-gray-800">BCC:</span>
                            <div class="flex flex-wrap gap-1 mt-1">
                                ${BCCEMails.map(email => `<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">${email}</span>`).join('')}
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <!-- Email Body -->
                    <div class="flex-1 overflow-y-auto p-4">
                        <div id="email-body-content" class="prose max-w-none">
                            <!-- Quill content will be rendered here -->
                            <div class="text-center py-8 text-gray-500">
                                <i class="bi bi-hourglass-split text-3xl mb-3 animate-pulse"></i>
                                <p>Loading email content...</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Attachments -->
                    ${Attachments.length > 0 ? `
                    <div class="p-4 border-t border-gray-200 bg-gray-50">
                        <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                            <i class="bi bi-paperclip mr-2"></i> Attachments (${Attachments.length})
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            ${Attachments.map(attachment => `
                                <a href="${processEndpoint}/item?url=${attachment.file_path}" 
                                   target="_blank" 
                                   class="flex items-center p-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <i class="bi bi-file-earmark-text text-primary mr-2"></i>
                                    <span class="text-sm truncate">${attachment.file_name}</span>
                                </a>
                            `).join('')}
                        </div>
                    </div>
                    ` : ''}
                </div>
            `;
            
            // Re-attach back button event
            document.getElementById("backButton").addEventListener("click", function() {
                emailContent.classList.remove("open");
            });
            
            // Parse and render Quill content
            try {
                const quillContent = JSON.parse(email.body);
                renderQuillAsHTML('email-body-content', quillContent);
            } catch (error) {
                console.error("Error parsing Quill content:", error);
                document.getElementById('email-body-content').innerHTML = `
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-yellow-800">Could not display email content properly. Showing raw text:</p>
                        <div class="mt-2 p-3 bg-white rounded border">
                            ${email.body}
                        </div>
                    </div>
                `;
            }
            
        } else {
            emailContent.innerHTML = `
                <div class="flex flex-col w-full">
                    <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                        <button id="backButton" class="md:hidden p-2 rounded-lg hover:bg-gray-200">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <h3 class="text-lg font-semibold text-gray-800">Error</h3>
                    </div>
                    <div class="flex-1 overflow-y-auto p-4 flex items-center justify-center">
                        <div class="text-center text-red-500">
                            <i class="bi bi-exclamation-triangle text-4xl mb-3"></i>
                            <p class="text-lg">Could not retrieve email at this time</p>
                            <p class="text-sm mt-1">Please try again later</p>
                        </div>
                    </div>
                </div>
            `;
            
            // Re-attach back button event
            document.getElementById("backButton").addEventListener("click", function() {
                emailContent.classList.remove("open");
            });
        }
    } catch (error) {
        console.error("Error fetching email content:", error);
        emailContent.innerHTML = `
            <div class="flex flex-col w-full">
                <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <button id="backButton" class="md:hidden p-2 rounded-lg hover:bg-gray-200">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    <h3 class="text-lg font-semibold text-gray-800">Network Error</h3>
                </div>
                <div class="flex-1 overflow-y-auto p-4 flex items-center justify-center">
                    <div class="text-center text-red-500">
                        <i class="bi bi-wifi-off text-4xl mb-3"></i>
                        <p class="text-lg">Network error</p>
                        <p class="text-sm mt-1">Please check your connection and try again</p>
                    </div>
                </div>
            </div>
        `;
        
        // Re-attach back button event
        document.getElementById("backButton").addEventListener("click", function() {
            emailContent.classList.remove("open");
        });
    }
}

function renderQuillAsHTML(divId, deltaContent) {
    try {
        // Create a Quill instance in a temporary div
        const tempDiv = document.createElement('div');
        const quill = new Quill(tempDiv, {
            theme: 'snow',
            modules: { toolbar: false },
            readOnly: true,
        });

        // Set the content as Quill Delta and extract the HTML
        quill.setContents(deltaContent);

        // Get the innerHTML from the Quill editor
        const htmlContent = tempDiv.innerHTML;

        // Render the extracted HTML into the specified div
        document.getElementById(divId).innerHTML = htmlContent;
        
        // Add Tailwind prose classes for better typography
        document.getElementById(divId).classList.add('prose', 'max-w-none');
        
    } catch (error) {
        console.error("Error rendering Quill content:", error);
        document.getElementById(divId).innerHTML = `
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-yellow-800">Error displaying formatted content. Showing raw data:</p>
                <pre class="mt-2 p-3 bg-white rounded border overflow-auto">${JSON.stringify(deltaContent, null, 2)}</pre>
            </div>
        `;
    }
}

export {
    GetEmailContent
}