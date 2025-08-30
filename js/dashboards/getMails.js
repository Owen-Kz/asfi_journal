import { GetParameters, parentDirectoryName, submissionsEndpoint } from "../constants.js"
import { GetCookie } from "../setCookie.js"
import { GetAccountData } from "./accountData.js"
import { GetEmailContent } from "./getMailContent.js"

const emailListContainer = document.getElementById("emailListContainer")
const emailContent = document.getElementById("emailContent")
const userID = GetCookie("user")
const userData = await GetAccountData(userID)
const user = userData.email
const totalMessagesEl = document.getElementById("totalMessages")
const unreadMessagesEl = document.getElementById("unreadMessages")
const mobileTotalMessagesEl = document.getElementById("mobileTotalMessages")
const mobileUnreadMessagesEl = document.getElementById("mobileUnreadMessages")
const backButton = document.getElementById("backButton")

// Mobile functionality
backButton.addEventListener("click", function() {
    emailContent.classList.remove("open")
})

if(user){
    let unreadCount = 0;
    let totalCount = 0;

    function showEmailContent(emailId) {
        // Show loading state
        emailContent.innerHTML = `
            <div class="flex flex-col w-full">
                <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <button id="backButton" class="md:hidden p-2 rounded-lg hover:bg-gray-200">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                    <h3 class="text-lg font-semibold text-gray-800">Loading message...</h3>
                </div>
                <div class="flex-1 overflow-y-auto p-4 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <i class="bi bi-hourglass-split text-4xl mb-3 animate-pulse"></i>
                        <p class="text-lg">Loading message content</p>
                    </div>
                </div>
            </div>
        `;
        
        // Re-attach back button event
        document.getElementById("backButton").addEventListener("click", function() {
            emailContent.classList.remove("open")
        });
        
        // Show email content on mobile
        emailContent.classList.add("open");
        
        // Get email content
        GetEmailContent(emailId).then(() => {
            // Set Email Status to read 
            fetch(`https://greek.asfirj.org/backend/email/setStatus/index.php?e_id=${emailId}`)
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    const currentEmail = document.querySelector(`[data-id="${emailId}"]`);
                    if(currentEmail) {
                        currentEmail.classList.remove("unread");
                        currentEmail.classList.add("selected");
                        
                        // Update unread count
                        unreadCount--;
                        updateMessageCounts();
                    }
                }
            });
        });
    }

    // Get Emails Related to the user 
    fetch(`https://greek.asfirj.org/backend/accounts/emailList.php?u_id=${user}`)
    .then(res => res.json())
    .then(data => {
        if(data){
            emailListContainer.innerHTML = ''; // Clear loading message
            
            if(data.emails && data.emails.length > 0){
                const EmailList = data.emails;
                totalCount = EmailList.length;
                
                EmailList.forEach(email => {
                    let messageStatus = "";
                    let isUnread = false;
                    
                    if(email.status === "Delivered"){
                        messageStatus = "unread";
                        isUnread = true;
                        unreadCount++;
                    }
                    
                    const emailDate = new Date(email.date_sent);
                    const formattedDate = emailDate.toLocaleDateString() + ' ' + emailDate.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    
                    emailListContainer.innerHTML += `
                        <div class="email-item ${messageStatus} p-4 cursor-pointer" data-id="${email.id}">
                            <div class="flex justify-between items-start mb-2">
                                <div class="font-semibold text-gray-800 text-sm truncate">${email.subject}</div>
                                <div class="text-xs text-gray-500 whitespace-nowrap">${formattedDate}</div>
                            </div>
                            <div class="text-sm text-gray-600 truncate">To: ${email.recipient}</div>
                            ${isUnread ? '<div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>' : ''}
                        </div>
                    `;
                });
                
                // Add event listeners to email items
                const emailItems = document.querySelectorAll(".email-item");
                emailItems.forEach(item => {
                    item.addEventListener("click", function() {
                        // Remove selected class from all items
                        emailItems.forEach(i => i.classList.remove("selected"));
                        // Add selected class to clicked item
                        this.classList.add("selected");
                        
                        showEmailContent(this.getAttribute("data-id"));
                    });
                });
                
            } else {
                emailListContainer.innerHTML = `
                    <div class="p-4 text-center text-gray-500">
                        <i class="bi bi-inbox text-3xl mb-2"></i>
                        <p>No emails have been sent to you yet</p>
                    </div>
                `;
            }
            
            updateMessageCounts();
        }
    })
    .catch(error => {
        console.error("Error fetching emails:", error);
        emailListContainer.innerHTML = `
            <div class="p-4 text-center text-red-500">
                <i class="bi bi-exclamation-triangle text-3xl mb-2"></i>
                <p>Error loading emails. Please try again later.</p>
            </div>
        `;
    });

    function updateMessageCounts() {
        if(totalMessagesEl) totalMessagesEl.textContent = totalCount;
        if(unreadMessagesEl) unreadMessagesEl.textContent = unreadCount;
        if(mobileTotalMessagesEl) mobileTotalMessagesEl.textContent = totalCount;
        if(mobileUnreadMessagesEl) mobileUnreadMessagesEl.textContent = unreadCount;
    }

} else {
    window.location.href = `${parentDirectoryName}/Dashboard`;
}