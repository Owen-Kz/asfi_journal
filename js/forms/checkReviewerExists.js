import { submissionsEndpoint } from "../constants.js";

async function CheckReviewerExists(email){
  return  fetch(`https://greek.asfirj.org/backend/reviewers/validateAccountExists.php`, {
        method:"POST",
        body: JSON.stringify({encrypted:email}),
        headers:{
            'Content-type' : 'application/JSON'
        }
    }).then(res=>res.json())
    .then(data =>{
        if(data.status === "accountExists"){
            return true
        }else{
            return false
        }
    })
}

export {
    CheckReviewerExists
}