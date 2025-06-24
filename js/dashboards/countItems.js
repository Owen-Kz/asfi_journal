import { submissionsEndpoint } from "../constants.js"
import { GetCookie } from "../setCookie.js"
import { GetAccountData } from "./accountData.js"

const inReviewCount = document.querySelectorAll(".inReviewCount")
const newSubmissionsCount = document.querySelectorAll(".newSubmissionsCount")
const acceptedCount = document.querySelectorAll(".acceptedCount")
const publishedCount = document.querySelectorAll(".publishedCount")
const reviewsCount = document.querySelectorAll(".reviewsCount")
const coAuthoredCount = document.querySelectorAll(".coAuhtoredCount")
const submittedReviewsCount = document.querySelectorAll(".submittedReviewsCount")
const inboxCount = document.querySelectorAll(".inboxCount")

const userID = GetCookie("user")
const UserData = await GetAccountData(userID)
const user = UserData.email


if(user){
    if(inboxCount){
        
        
        fetch(`https://test.asfirj.org/backend/accounts/emailList.php?u_id=${UserData.email}`, {

        }).then(res=>res.json())
        .then(data=>{
            if(data){
                if(data.emails){
                    const EmailList = data.emails 
                    inboxCount.forEach(inbox =>{
                        inbox.innerText = EmailList.length
                    })
                }
            }
        })
    }
if(inReviewCount){
    // GEt the REviesCount from database 
    fetch(`https://test.asfirj.org/backend/accounts/InReviewCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=> {
        inReviewCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

if(newSubmissionsCount){
    fetch(`https://test.asfirj.org/backend/accounts/newSubmissionsCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=>{
        newSubmissionsCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

if(acceptedCount){
    fetch(`https://test.asfirj.org/backend/accounts/acceptedCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=>{
        acceptedCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

if(publishedCount){
    fetch(`https://test.asfirj.org/backend/accounts/publishedCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=>{
        publishedCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

if(reviewsCount){
    fetch(`https://test.asfirj.org/backend/accounts/reviewsCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=>{
        reviewsCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

if(coAuthoredCount){
    fetch(`https://test.asfirj.org/backend/accounts/coAuthoredCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=>{
        coAuthoredCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

if(submittedReviewsCount){
    fetch(`https://test.asfirj.org/backend/accounts/submittedReviewsCount.php?u_id=${user}`)
    .then(res=>res.json())
    .then(data=>{
        submittedReviewsCount.forEach(count =>{
            count.innerText = data.count
        })
    })
}

}