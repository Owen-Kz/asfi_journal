import { submissionsEndpoint } from "../constants.js"

async  function GetCCEmails(emailID){
    return fetch(`https://greek.asfirj.org/backend/email/getCCEmail.php?e=${emailID}`)
    .then(res =>res.json())
    .then(data =>{
        if(data.status === "success"){
            return data.cc
        }else{
            return []
        }
    })
}
export {
    GetCCEmails
}