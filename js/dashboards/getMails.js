// import { GetParameters, parentDirectoryName, submissionsEndpoint } from "../constants.js"
// import { formatTimestamp } from "../formatDate.js"
// import { GetCookie } from "../setCookie.js"

import { GetParameters, parentDirectoryName, submissionsEndpoint } from "../constants.js"
import { GetCookie } from "../setCookie.js"
import { GetAccountData } from "./accountData.js"
import { GetEmailContent } from "./getMailContent.js"

// import { GetEmailContent } from "./getEmails.js"
const emailListContainer = document.getElementById("emailListContainer")
const userID = GetCookie("user")
const userData = await GetAccountData(userID)
const user = userData.email
const expandForum = document.querySelector(".expand-forum")
const emailContentContainer = document.getElementById("email-content");

expandForum.addEventListener("click", function(){
    emailListContainer.classList.toggle('small');
    emailContentContainer.classList.toggle("wide");
})

if(user){

function showEmailContent(emailId) {
   
    emailContentContainer.innerHTML = ``
    GetEmailContent(emailId)
      // Set Email Status to read 
      fetch(`https://test.asfirj.org/backend/email/setStatus/index.php?e_id=${emailId}`, {

        
      }).then(res=>res.json())
      .then(data=>{
          if(data.success){
              const currentEmail = $(`[data-id="${emailId}"]`);
  
              currentEmail.removeClass("newMessage")
              // currentEmail.attr("class", "emailItem");
  
          }
      })

}
// Get Emails Related to the user 
fetch(`https://test.asfirj.org/backend/accounts/emailList.php?u_id=${user}`, {

}).then(res=>res.json())
.then(data=>{
    if(data){
        if(data.emails){
            const EmailList = data.emails 
            EmailList.forEach(email =>{
                let MessageStatus = ""
                if(email.status === "Delivered"){
                    MessageStatus = "newMessage"
                }
                emailListContainer.innerHTML += `
                <div class="email-item ${MessageStatus}" data-id=${email.id} >
                      <div class="email-subject">${email.subject}</div>
                      <div class="email-recipient">${email.recipient}</div>
                    </div>`
            })
        }else{
            emailListContainer.innerHTML = `<b>No Email Has been sent to you yet</b>`
        }
    }

    // Initial content display (optional)
      const Emailitems = document.querySelectorAll(".email-item")
    Emailitems.forEach(item=>{
        item.addEventListener("click", function(){
            emailListContainer.classList.toggle('small');
    emailContentContainer.classList.toggle("wide");
            showEmailContent(item.getAttribute("data-id"))
        })
    })
 
})


}else{
    window.location.href = `${parentDirectoryName}/Dashboard`
}
